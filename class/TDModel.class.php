<?php

/*
 * @ autor Alexandr Kozyr kozyr1av@gmail.com;
 * @ phone: +380662053435;
 * class TDModel aggregates all methods for Data changing and pulling from Tecdoc DataBase
 */

class TDModel {

    private $mSQLCon;

    /**
     * creating DB connection
     */
    public function __construct() {
        $this->mSQLCon = DBConnect::MySQL();
    }

    /**
     * this method aggregates getOneLetterManufacturers and getAlphabet methods
     * to return actual information about manufacturers' brands
     * 
     * @return array $manufacturers
     */
    public function getManufacturers() {
        $alphabet = $this->getAlphabet();
        $manufacturers = array();
        foreach ($alphabet as $item) {
            $manufacturers[$item] = $this->getOneLetterManufacturers($item);
        }

        return $manufacturers;
    }

    /**
     * 
     * @param string $firstletter
     * @return array $onelettermanufacturers
     */
    public function getOneLetterManufacturers($firstletter) {
        $firstletter = $firstletter . '%';
        $stm = $this->mSQLCon->prepare(
                "SELECT
                    mfr.`mfa_brand`
                FROM
                    `manufacturers` AS `mfr`
                WHERE mfr.status = 1 AND mfr.`mfa_brand` LIKE :fl"
        );
        $stm->bindParam(':fl', $firstletter, PDO::PARAM_STR);
        $stm->execute();
        $onelettermanufacturers = $stm->fetchAll(PDO::FETCH_COLUMN);
        return $onelettermanufacturers;
    }

    /**
     * this method returns only existed first letters in data base
     * @return array $alphabet
     */
    public function getAlphabet() {
        $stm = $this->mSQLCon->prepare(
                "SELECT
                    mfr.`mfa_brand`
                FROM
                    `manufacturers` AS `mfr`
                WHERE mfr.status = 1"
        );
        $stm->execute();
        $manufacturers = $stm->fetchAll(PDO::FETCH_COLUMN);
        sort($manufacturers);
        foreach ($manufacturers as &$item) {
            $item = substr($item, 0, 1);
        }
        $alphabet = array_unique($manufacturers);
        return $alphabet;
    }

    /**
     * 
     * @param string $brand
     * @return array $models
     */
    public function getModel($brand) {
        $stm = $this->mSQLCon->prepare(
                "SELECT 
                    `mod_id`,
                    `tex_text` 
                  FROM
                    `manufacturers` mfr 
                    INNER JOIN `models` mdl 
                      ON mfr.`mfa_id` = mdl.`mod_mfa_id` 
                    INNER JOIN `country_designations` cdes 
                      ON mdl.`mod_cds_id` = cdes.`cds_id` 
                    INNER JOIN `des_texts` dtex 
                      ON cdes.`cds_tex_id` = dtex.`tex_id` 
                  WHERE mdl.status = '1' AND cdes.`cds_lng_id` = 16 AND mfr.`mfa_brand` = :b GROUP BY mdl.`mod_id`"
        );
        $stm->bindParam(':b', $brand, PDO::PARAM_STR);
        $stm->execute();
        $models = $stm->fetchAll(PDO::FETCH_NUM);
        return $models;
    }

    /**
     * 
     * @param string $modelId
     * @return array $types
     */
    public function getTypes($modelId) {
        $stm = $this->mSQLCon->prepare(
                "SELECT 
                    `typ_id`,
                    `tex_text` 
                  FROM
                    `models` mdl 
                    INNER JOIN `types` typ 
                      ON mdl.`mod_id` = typ.`typ_mod_id` 
                    INNER JOIN `country_designations` cdes 
                      ON typ.`typ_mmt_cds_id` = cdes.`cds_id` 
                    INNER JOIN `des_texts` dtex 
                      ON cdes.`cds_tex_id` = dtex.`tex_id` 
                  WHERE mdl.`mod_id` = :m
                  AND typ.status = 1
                  GROUP BY typ.`typ_id`"
        );
        $stm->bindParam(':m', $modelId, PDO::PARAM_INT);
        $stm->execute();
        $types = $stm->fetchAll(PDO::FETCH_NUM);
        return $types;
    }

    /**
     * 
     * @param string $typeId
     * @return array $treeBranches
     */
    public function buildTree($typeId) {
        $stm = $this->mSQLCon->prepare(
                "SELECT DISTINCT 
                  STR_ID AS `id`,
                  STR_ID_PARENT AS `parentId`,
                  TEX_TEXT AS `text`,
                  IF(
                    EXISTS 
                    (SELECT 
                      * 
                    FROM
                      search_tree AS search_tree2 
                    WHERE search_tree2.STR_ID_PARENT = search_tree.STR_ID 
                    LIMIT 1),
                    1,
                    0
                  ) AS `gotChild` 
                FROM
                  search_tree
                  INNER JOIN link_ga_str 
                    ON LGS_STR_ID = STR_ID 
                  INNER JOIN link_la_typ 
                    ON LAT_GA_ID = LGS_GA_ID 
                    AND link_la_typ.status = 1 
                  INNER JOIN designations 
                    ON DES_ID = STR_DES_ID 
                  INNER JOIN des_texts 
                    ON TEX_ID = DES_TEX_ID 
                WHERE LAT_TYP_ID = :typeId
                  AND STR_ID LIKE '1%' 
                  AND STR_ID_PARENT != 13771 
                  AND STR_ID != 13771 
                  AND DES_LNG_ID = 16
                  AND search_tree.status = 1");
        $stm->bindParam(':typeId', $typeId, PDO::PARAM_INT);
        $stm->execute();
        //print_r($stm->errorInfo());
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);
        $treeBranches = array();
        foreach ($result as $v) {
            $treeBranches[$v['id']] = $v;
        }
        ksort($treeBranches);

        $finalResult = array();
        foreach ($treeBranches as $v) {
            $finalResult[$v['parentId']][] = $v;
        }
        return $finalResult;
    }

    /**
     * 
     * @param string $typeId
     * @param string $strId
     * @return array $result
     */
    public function allPossibleArticles($typeId, $branchId) {

        $stm = $this->mSQLCon->prepare(
                "SELECT 
                    `name`,
                    url,
                    updated_at,
                    art_id,
                    art_article_nr AS art_number,
                    brand
                  FROM
                    link_ga_str 
                    INNER JOIN link_la_typ 
                      ON LAT_TYP_ID = :typeId 
                      AND LAT_GA_ID = LGS_GA_ID
                    INNER JOIN link_art 
                      ON LA_ID = LAT_LA_ID 
                    INNER JOIN articles 
                      ON la_art_id = art_id AND articles.status < 2
                      WHERE LGS_STR_ID <=> :branchId 
                  ORDER BY LA_ART_ID 
                "
        );
        $stm->bindParam(':typeId', $typeId, PDO::PARAM_INT);
        $stm->bindParam(':branchId', $branchId, PDO::PARAM_INT);
        $stm->execute();
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    /**
     * 
     * @param string $typeId
     * @param string $strId
     * @return string $result
     */
    public function allPossibleArticlesCSV($typeId, $strId) {
        $stm = $this->mSQLCon->prepare(
                "
                SELECT
                   art_id,
                   art_article_nr as art_number
                  FROM
                    link_ga_str 
                    INNER JOIN link_la_typ 
                      ON LAT_TYP_ID = :typeId 
                      AND LAT_GA_ID = LGS_GA_ID 
                    INNER JOIN LINK_ART 
                      ON LA_ID = LAT_LA_ID 
                    INNER JOIN articles 
                      ON la_art_id = art_id 
                    
                  WHERE LGS_STR_ID <=> :strId 
                  ORDER BY LA_ART_ID 
                "
        );
        $stm->bindParam(':typeId', $typeId, PDO::PARAM_INT);
        $stm->bindParam(':strId', $strId, PDO::PARAM_INT);
        $stm->execute();
        $tempResult = $stm->fetchAll(PDO::FETCH_NUM);
        $resultArray = array();
        foreach ($tempResult as $item) {
            $resultArray[] = implode(';', $item);
        }
        $result = implode('~', $resultArray);
        return $result;
    }

    /**
     * 
     * @param string $CSVString
     * @return array $result
     */
    public function updateDataFromOuterDB($CSVString) {

        $url = 'http://server.mobilluck.com.ua/tecdoc.php';
        $params = array(
            'data' => $CSVString
        );
        $result = file_get_contents($url, false, stream_context_create(array(
            'http' => array(
                'method' => 'POST',
                'header' => 'Content-type: application/x-www-form-urlencoded',
                'content' => http_build_query($params)
            )
        )));


        $jresult = json_decode($result, true);
        return $jresult;
    }

    /**
     * this method update our aplication DB
     * @param array $arrayWithUrls
     */
    public function putUrlToAppDB($arrayWithUrls) {


        $curDateTime = date('Y-m-d H:i:s');

        foreach ($arrayWithUrls as $item) {

            $stm = $this->mSQLCon->prepare(
                    "
                    UPDATE
                    articles AS art
                    SET
                    art.`url` = :url,
                    art.`name` = :name,
                    art.`brand` = :brand,
                    art.`updated_at` = :datetime
                    WHERE art.`ART_ID`= :artId 
                "
            );
            $stm->bindValue(':url', isset($item["url"]) ? $item["url"] : " ", PDO::PARAM_STR);
            $stm->bindValue(':name', isset($item["name"]) ? $item["name"] : " ", PDO::PARAM_STR);
            $stm->bindValue(':brand', isset($item["brand"]) ? $item["brand"] : " ", PDO::PARAM_STR);
            $stm->bindParam(':datetime', $curDateTime, PDO::PARAM_STR);
            $stm->bindValue(':artId', $item["article_id"], PDO::PARAM_INT);
            $stm->execute();
        }
    }

    /**
     * this method returns name of type using its id
     * @param int $typeId
     */
    public function getTypeById($typeId) {
        $stm = $this->mSQLCon->prepare(
                "
                   SELECT 
                    dtex.`tex_text` AS `name`
                    FROM
                    `types` AS typ
                    INNER JOIN country_designations AS cdes
                    ON typ.`typ_mmt_cds_id`=cdes.`cds_id`
                    INNER JOIN des_texts AS dtex
                    ON cdes.`cds_tex_id`=dtex.`tex_id`
                    WHERE typ.`typ_id` = :typeId AND cdes.`cds_lng_id`=16 GROUP BY typ.`typ_id`
                "
        );
        $stm->bindParam(':typeId', $typeId, PDO::PARAM_STR);
        $stm->execute();
        $result = $stm->fetchColumn();
        return $result;
    }
    public function getMFRById($typeId) {
        $stm = $this->mSQLCon->prepare(
                "
                   SELECT 
                        mfr.`mfa_brand` AS `name` 
                       FROM
                         `types` AS typ 
                         INNER JOIN models AS m 
                           ON typ.`typ_mod_id` = m.`mod_id` 
                         INNER JOIN manufacturers AS mfr 
                           ON m.`mod_mfa_id` = mfr.`mfa_id` 
                       WHERE typ.`typ_id` = :typeId

                       GROUP BY mfr.`mfa_id` 
                "
        );
        $stm->bindParam(':typeId', $typeId, PDO::PARAM_STR);
        $stm->execute();
        $result = $stm->fetchColumn();
        return $result;
    }

    /**
     * this method returns name of branch using its id
     * @param int $brandId
     */
    public function getBranchById($branchId) {
        $stm = $this->mSQLCon->prepare(
                "
                   SELECT 
                        dtex.`tex_text` AS `name` 
                      FROM
                        `search_tree` AS str 
                        INNER JOIN designations AS des 
                          ON str.`str_des_id` = des.`des_id` 
                        INNER JOIN des_texts AS dtex 
                          ON des.`des_tex_id` = dtex.`tex_id` 
                      WHERE str.`str_id` = :branchId 
                        AND des.`des_lng_id` = 16 
                "
        );
        $stm->bindParam(':branchId', $branchId, PDO::PARAM_STR);
        $stm->execute();
        $result = $stm->fetchColumn();
        return $result;
    }
    /**
     * gets criterias of all articles from base
     * @return array of criteria
     */
    public function getCriteriaValue(){
        $stm = $this->mSQLCon->prepare(
                "SELECT
                    *
                    FROM

                    (SELECT 
                      art.`site_id`,
                      dtext.`tex_text` AS criteria,
                      acri.`acr_value` AS criteria_value 
                    FROM
                      `articles` AS art 
                      INNER JOIN `article_criteria` AS acri 
                        ON art.`art_id` = acri.`acr_art_id` 
                      INNER JOIN `criteria` AS cri 
                        ON acri.`acr_cri_id` = cri.`cri_id` 
                      INNER JOIN `designations` AS des 
                        ON cri.`cri_des_id` = des.`des_id` 
                        AND des.`des_lng_id` = 16 
                      INNER JOIN `des_texts` AS dtext 
                        ON des.`des_tex_id` = dtext.`tex_id` 
                    WHERE art.`status` = 1 
                      AND acri.`acr_value` IS NOT NULL
                      UNION
                      SELECT 
                      art.`site_id`,
                      dtext.`tex_text` AS criteria,
                      dtext1.`tex_text` AS criteria_value 
                    FROM
                      articles AS art 
                      INNER JOIN `article_criteria` AS acri 
                        ON art.`art_id` = acri.`acr_art_id` 
                      LEFT JOIN `criteria` AS cri 
                        ON acri.`acr_cri_id` = cri.`cri_id` 
                      INNER JOIN `designations` AS des 
                        ON cri.`cri_des_id` = des.`des_id` 
                        AND des.`des_lng_id` = 16 
                      INNER JOIN `des_texts` AS dtext 
                        ON des.`des_tex_id` = dtext.`tex_id` 
                      INNER JOIN `designations` AS des1 
                        ON acri.`acr_kv_des_id` = des1.`des_id` 
                        AND des1.`des_lng_id` = 16 
                      INNER JOIN `des_texts` AS dtext1 
                        ON des1.`des_tex_id` = dtext1.`tex_id` 
                    WHERE art.`status` = 1 ) AS un
                    ORDER BY un.`site_id`
                "
        );
        $stm->execute();
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }
   
   
}

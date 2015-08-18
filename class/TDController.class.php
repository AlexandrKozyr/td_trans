<?php

/*
 * @ author Alexandr Kozyr kozyr1av@gmail.com;
 * @ phone: +380662053435;
 *  class TDControler is fromt controler for public article look up
 */

class TDController {

    /**
     * 
     */
    public function process() {

        //2stStep
        if (isset($_GET["mfr"])) {
            $this->secondStep($_GET["mfr"]);
            //manufacturer AJAX (return manufacturer's models)
        } else if ($_POST["ajax"] == 1) {
            echo $this->ajaxModel($_POST["brand"]);
            //model AJAX (return manufacturer+models' types)
        } else if ($_POST["ajax"] == 2) {
            echo $this->ajaxType($_POST['modelId']);
            //type AJAX (return tree for manufacturer+models+types)
        } else if ($_POST["ajax"] == 3) {
            echo $this->buildTree($_POST['typeId']);

            //3dStep (return all articles at our base)
        } else if (isset($_GET["branchId"])) {
            $this->thirdStep($_GET);
            //criteria from base to csv file
        } else if (isset($_GET["criCsv"])) {
            $this->criteriaCSV();
            //1stStep
        } else {
            $this->firstStep();
        }
    }

    /**
     * 
     */
    public function firstStep() {
        $smarty = new Smarty();
        $mod = new TDModel();

        $result = $mod->getManufacturers();
        $smarty->assign('result', $result);
        $smarty->display('view/step1.tpl');
    }

    public function secondStep($manufacturer) {
        $smarty = new Smarty();
        $mod = new TDModel();

        $manufacturersList = $mod->getManufacturers();
        $modelsList = $this->getModel($manufacturer);

        $smarty->assign('curMfr', $manufacturer);
        $smarty->assign('mfrList', $manufacturersList);
        $smarty->assign('modList', $modelsList);

        $smarty->display('view/step2.tpl');
    }

    /**
     * 
     * @param string $manufacturer
     */
    public function ajaxModel($manufacturer) {
        $mod = new TDModel();
        $result = $mod->getModel($manufacturer);

        return json_encode($result);
    }

    /**
     * 
     * @param array $modelId coming from GET
     */
    public function ajaxType($modelId) {
        $mod = new TDModel();
        $result = $mod->getTypes($modelId);
        return json_encode($result);
    }

    /**
     * 
     * @param string $manufacturer
     */
    public function getModel($manufacturer) {

        $mod = new TDModel();

        $result = $mod->getModel($manufacturer);

        return $result;
    }

    /**
     * 
     * @param array $type coming from GET
     */
    public function buildTree($typeId) {
        $smarty = new Smarty();
        $mod = new TDModel();
        $result = $mod->buildTree($typeId);
        $smarty->assign('result', $result);
        $smarty->assign('typeId', $typeId);
        $smarty->display('view/step2_tree.tpl');
    }

    /**
     * 
     * @param array $searchTree coming from GET consist of typeId and brandchId
     */
    public function thirdStep($searchTree) {
        $smarty = new Smarty();
        $mod = new TDModel();

        $res = $mod->allPossibleArticles($searchTree['typeId'], $searchTree['branchId']);

        $carName = $mod->getTypeById($searchTree['typeId']);
        $branchName = $mod->getBranchById($searchTree['branchId']);
        $mfrName = $mod->getMFRById($searchTree['typeId']);

        $smarty->assign('carName', $carName);
        $smarty->assign('branchName', $branchName);
        $smarty->assign('mfrName', $mfrName);
        $smarty->assign('result', $res);
        $smarty->display('view/step3.tpl');
    }

    public function criteriaCSV() {
        $mod = new TDModel();
        $res = $mod->getCriteriaValue();
        $c=count($res);
        
        for($r=0; $r<$c; $r++){
            if(is_int (strpos($res[$r]['criteria'], 'фаски'))){
                $res[$r]['criteria'] = 'высота фаски [мм]';
                
            }
            
        }
        // makes uniq array where key == site_id
        $tmp = array();
        foreach ($res as &$i) {

            $tmp[$i['site_id']][] = $i;
        }
        foreach ($tmp as $key => $item) {
            $string .= $key . ";";
            $c = count($item);
            for ($i = 0; $i < $c; $i++) {
                if ($i == ($c - 1)) {
                    $string .=$item[$i]["criteria"] . ' - ' . $item[$i]["criteria_value"] . "\r\n";
                } else {
                    $string .=$item[$i]["criteria"] . ' - ' . $item[$i]["criteria_value"] . ' / ';
                }
            }
        }
        $filename = 'tmp/Criterias_TecDoc_' . date('Y-m-d') . '.txt';

        file_put_contents($filename, $string);
        echo 'Получено информацию по '.count($tmp).' товарам. </br>';
        echo '<a download href = "' . $filename . '">Скачать</a>';
    }

}

<?php
    $db_user = 'tecdoc';
    $db_password = '4Qaq4PXA6HEMnJG2';
    $db_host = 'localhost';
    
    $db_ml = 'mobilluck_db';
    $db_td = 'tecdoc';

    mysql_connect($db_host,$db_user,$db_password);
	
    function EncodeURL( $strsrc )
    {
        $tmpstr = $strsrc;

        $ruschar = " _+-%&1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyzA¡¬√ƒ≈®∆«»… ÀÃÕŒœ–—“”‘’÷◊ÿŸ⁄€‹›ﬁﬂ‡·‚„‰Â∏ÊÁËÈÍÎÏÌÓÔÒÚÛÙıˆ˜¯˘˙˚¸˝˛ˇ\x2B";
        $engchar = "__+-_+1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyzABVGDEEGZIIKLMNOPRSTUFHCCSS_I_EUYabvgdeegziiklmnoprstufhccss_i_euy+";

        $ruschar = " _+-%&1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyzA¡¬√ƒ≈®∆«»… ÀÃÕŒœ–—“”‘’÷◊ÿŸ⁄€‹›ﬁﬂ‡·‚„‰Â∏ÊÁËÈÍÎÏÌÓÔÒÚÛÙıˆ˜¯˘˙˚¸˝˛ˇ\x2B";
        $engchar = Array("_", "_", "+", "-", "_", "+", "1", "2", "3", "4", "5", "6", "7", "8", "9", "0",
            "A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z",
            "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z",
            "A", "B", "V", "G", "D", "E", "JO", "ZH", "Z", "I", "JJ", "K", "L", "M", "N", "O", "P", "R", "S",
            "T", "U", "F", "KH", "C", "CH", "SH", "SHH", "_", "Y", "_", "EH", "JU", "JA",
            "a", "b", "v", "g", "d", "e", "jo", "zh", "z", "i", "jj", "k", "l", "m", "n", "o", "p", "r", "s",
            "t", "u", "f", "kh", "c", "ch", "sh", "shh", "_", "y", "_", "eh", "ju", "ja", "+");

        for($i=0; $i<strlen($tmpstr); $i++)
        {
            $pos = strpos($ruschar, $tmpstr[$i]);
            if( $pos === false )
            {
                $tmpstr[$i] = "_";
            }
            else
            {
                $tmpstr[$i] = $engchar[$pos];
            }
        }

        return $tmpstr;
    }
    
    $query = "UPDATE ".$db_td.".articles SET status = '5'";    
	if( !mysql_query($query) )
	{
        echo mysql_error()."\n";
	}
    
    mysql_query("SET character_set_client = 'cp1251'");
	mysql_query("SET character_set_results = 'cp1251'");
	mysql_query("SET character_set_connection = 'cp1251'");
    $reset = true;
    $query =  " SELECT art.	ART_ID, i.id, i.status, i2.fullname, s.urlname, p.urlmake, p2.make_name, i.model "
            . " FROM ".$db_td.".articles art "
            . " INNER JOIN ".$db_ml.".mluck_cat_item i ON i.partno = art.ART_ARTICLE_NR AND i.is_archive = '0' "
            . " INNER JOIN ".$db_ml.".mluck_cat_item_lang i2 ON i2.item_id = i.id "
            . " INNER JOIN ".$db_ml.".mluck_cat_sectitem si ON si.item_id = i.id "
            . " INNER JOIN ".$db_ml.".mluck_cat_section s ON s.id = si.sect_id AND s.no_photo = '1' "
            . " INNER JOIN ".$db_ml.".mluck_cat_producer p ON p.id = i.make_id "
            . " INNER JOIN ".$db_ml.".mluck_cat_producer_lang p2 ON p2.make_id = p.id ";				
    if( $res = mysql_query( $query ) )
    {
        while( $row = mysql_fetch_object($res) )
        {
            //echo $row->ART_ID."\n";
            $site_id = $row->id;
            $url = "http://www.mobilluck.com.ua/katalog/".$row->urlname."/".$row->urlmake."/".$row->urlmake."-".EncodeURL($row->model)."-".$row->id.".html";
            $name = $row->fullname;
            $brand = $row->make_name;
            $status = $row->status;
            
            if( $reset )
            {
                mysql_query("SET character_set_client = 'utf-8'");
                mysql_query("SET character_set_results = 'utf-8'");
                mysql_query("SET character_set_connection = 'utf-8'");
                $reset = false;
            }
            
            $query =  " UPDATE ".$db_td.".articles "
                    . " SET "
                    . " site_id = '".$site_id."', "
                    . " url = '".$url."', "
                    . " name = '".$name."', "
                    . " brand = '".$brand."', "
                    . " status = '".$status."' "
                    . " WHERE ART_ID = '".$row->ART_ID."'";            
            if( !mysql_query($query) )
            {
                echo mysql_error()."\n";
            }
        }
    }
    else 
    {
        echo mysql_error()."\n";
    }
    
    //Ó·ÌÓ‚ÎˇÂÏ ÛÁÂÎ ‰ÂÂ‚‡
    $query =  " UPDATE ".$db_td.".search_tree st "            
            . " SET "
            . " st.status = '0'"
            . " WHERE st.status = '1' ";            
    if( !mysql_query($query) )
    {
        echo mysql_error()."\n";
    }
    $query =  " UPDATE ".$db_td.".search_tree st "
            . " INNER JOIN ".$db_td.".link_ga_str lgs ON lgs.LGS_STR_ID = st.STR_ID "
            . " INNER JOIN ".$db_td.".link_art la ON la.LA_GA_ID = lgs.LGS_GA_ID "
            . " INNER JOIN ".$db_td.".articles a ON a.ART_ID = la.LA_ART_ID AND a.status < '2' "
            . " SET "
            . " st.status = '1'";            
    if( !mysql_query($query) )
    {
        echo mysql_error()."\n";
    }
    $query =  " UPDATE ".$db_td.".types typ "            
            . " SET "
            . " typ.status = '0'"
            . " WHERE typ.status = '1' ";            
    if( !mysql_query($query) )
    {
        echo mysql_error()."\n";
    }
    $query =  " UPDATE ".$db_td.".types typ "
            . " INNER JOIN ".$db_td.".link_la_typ ltyp ON typ.TYP_ID = ltyp.LAT_TYP_ID "
            . " INNER JOIN ".$db_td.".link_art la ON la.LA_ID = ltyp.LAT_LA_ID "
            . " INNER JOIN ".$db_td.".articles a ON a.ART_ID = la.LA_ART_ID AND a.status < '2' "
            . " SET "
            . " typ.status = '1'";            
    if( !mysql_query($query) )
    {
        echo mysql_error()."\n";
    }
    
    $query =  " UPDATE ".$db_td.".models m "            
            . " SET "
            . " m.status = '0'"
            . " WHERE m.status = '1' ";            
    if( !mysql_query($query) )
    {
        echo mysql_error()."\n";
    }
    $query =  " UPDATE ".$db_td.".models m "
            . " INNER JOIN ".$db_td.".types typ ON typ.TYP_MOD_ID = m.MOD_ID AND typ.status = 1 "
            . " SET "
            . " m.status = '1'";            
    if( !mysql_query($query) )
    {
        echo mysql_error()."\n";
    }
    $query =  " UPDATE ".$db_td.".manufacturers mfr "            
            . " SET "
            . " mfr.status = '0'"
            . " WHERE mfr.status = '1' ";            
    if( !mysql_query($query) )
    {
        echo mysql_error()."\n";
    }
    $query =  " UPDATE ".$db_td.".manufacturers mfr "
            . " INNER JOIN ".$db_td.".models m ON m.MOD_MFA_ID = mfr.MFA_ID AND m.status = 1"
            . " SET "
            . " mfr.status = '1'";            
    if( !mysql_query($query) )
    {
        echo mysql_error()."\n";
    }
    
    
    //-
    $query =  " UPDATE ".$db_td.".link_la_typ ltyp "            
            . " SET "
            . " ltyp.status = '0'"
            . " WHERE ltyp.status = '1' ";            
    if( !mysql_query($query) )
    {
        echo mysql_error()."\n";
    }
    $query =  " UPDATE ".$db_td.".link_la_typ ltyp "
            . " INNER JOIN ".$db_td.".link_art la ON la.LA_ID = ltyp.LAT_LA_ID "
            . " INNER JOIN ".$db_td.".articles a ON a.ART_ID = la.LA_ART_ID AND a.status < '2' "
            . " INNER JOIN ".$db_td.".types typ ON typ.TYP_ID = ltyp.LAT_TYP_ID AND typ.status = '1' "
            . " SET "
            . " ltyp.status = '1'";            
    if( !mysql_query($query) )
    {
        echo mysql_error()."\n";
    }
    
    mysql_close();
?>
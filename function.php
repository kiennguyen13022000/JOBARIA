<?php
function pre ($expression, $wrap = true){
    $css = 'border:1px dashed #06f;padding:1em;text-align:left;';
    if ($wrap) {
        $str = '<p style="' . $css . '"><tt>' . str_replace(
                array('  ', "\n"), array('&nbsp; ', '<br />'),
                htmlspecialchars(print_r($expression, true))
            ) . '</tt></p>';
    } else {
        $str = '<pre style="' . $css . '">'
            . htmlspecialchars(print_r($expression, true)) . '</pre>';
    }
    echo $str;
}
function makeSlug($str) {
    if(!$str) return false;
    $str = str_replace(array('%',"/","\\",'"','?','<','>',"#","^","`","'","=","!",":" ,",,","..","*","&","__","▄",',','/','-',"́","̣","̀","̉","̃",".","–","…","(",")"),array('','','','','','','','','',"","",'','','','','','','','','',' ',' ','','','','','','','','','','',''),html_entity_decode(trim($str)));
    $unicode = array(
        'a'=>'ä|à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ|Ä|À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ',
        'd'=>'Đ|đ',
        'e'=>'è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ|È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ',
        'i'=>'ì|í|î|ị|ỉ|ĩ|Ì|Í|Ị|Ỉ|Ĩ',
        'o'=>'ö|ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ|Ö|Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ|ớ',
        'u'=>'ü|ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ|Ü|Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ',
        'y'=>'ỳ|ý|ỵ|ỷ|ỹ|Ỳ|Ý|Ỵ|Ỷ|Ỹ'
    );
    $count = 0;
    foreach($unicode as $nonUnicode=>$uni) {
        $str = preg_replace("/($uni)/i", $nonUnicode, addslashes($str));
        $count++;
    }
    if($count>0)
        for($i=0; $i<$count; $i++)
            $str = stripslashes($str);

    $str = preg_replace("/&([a-z])[a-z]+;/i","$1",$str);
    $str = preg_replace("/\s+/","-",$str);
    //$str = preg_match("[^A-Za-z0-9\-]", "", $str);
    return strtolower($str);
}

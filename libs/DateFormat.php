<?php

class DateFormat
{
    public static function createDateFormat($createDate){
        $arrCreateDate = date_parse_from_format('Y-m-d H:i:s', $createDate);

         $millisecondCurrent = time();
         $millisecondCreate = mktime($arrCreateDate['hour'], $arrCreateDate['minute'], $arrCreateDate['second'], $arrCreateDate['month'], $arrCreateDate['day'], $arrCreateDate['year']);
         $distance = $millisecondCurrent - $millisecondCreate;
        if ($distance < 24 * 60 * 60) {
            $strTime = date_format(date_create($createDate), 'H:i');
        }else if ($distance > 24 * 60 * 60){
            $strTime = date_format(date_create($createDate), 'd:m');
        }
        return $strTime;
    }
}
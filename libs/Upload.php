<?php
require_once 'public/phpThumb/ThumbLib.inc.php';
class Upload {
    public function uploadFile($file, $folder, $width = 60, $height = 90, $option = null) {
        if ($option == null) {
            if ($file['tmp_name'] != null) {
                $uploadDir = 'public/upload/' . $folder . '/';
                $fileName = $uploadDir . $file['name'];
                copy($file['tmp_name'], $fileName);
//                $thum = PhpThumbFactory::create($fileName);
//                $thum->adaptiveResize($width, $height);
//                $thum->save($uploadDir . $file['name']);
                return $file['name'];
            }
        }
    }

    public function removeFile($folder, $prefix, $arrfile) {

        if (is_array($arrfile)) {
            foreach ($arrfile as $item) {
                $dirFile = UPLOAD_PATH . $folder . '/' . $item;
                @unlink($dirFile);
                $dirFile = UPLOAD_PATH . $folder . '/' . $prefix . '-' . $item;
                @unlink($dirFile);
            }
        } else {
            $dirFile = UPLOAD_PATH . $folder . '/' . $arrfile;
            @unlink($dirFile);
            $dirFile = UPLOAD_PATH . $folder . '/' . $prefix . '-' . $arrfile;
            @unlink($dirFile);
        }

    }
}
?>
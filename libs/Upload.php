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
    public function getUrlFile($file, $folder, $width = 300, $height = 300, $option = null) {
        if ($option == null) {
            if ($file['tmp_name'] != null) {
                $uploadDir = 'public/upload/' . $folder . '/';
                $fileName = $uploadDir .time().'_'. $file['name'];
                copy($file['tmp_name'], $fileName);
//                $thum = PhpThumbFactory::create($fileName);
//                $thum->adaptiveResize($width, $height);
//                $thum->save($uploadDir . $file['name']);
                return $fileName;
            }
        }
    }
    public function removeFile($folder, $prefix = null, $arrfile) {
        if (is_array($arrfile)) {
            foreach ($arrfile as $item) {
                $dirFile = UPLOAD_PATH . $folder . '/' . $item;
                @unlink($dirFile);
                $dirFile = UPLOAD_PATH . $folder . '/' . $prefix . '-' . $item;
                @unlink($dirFile);
            }
        } else {
            $dirFile = 'public/upload/' . $folder . '/' . $arrfile;
            if(file_exists($dirFile)){
                @unlink($dirFile);
            }
        }
    }
    public function removeFileName($file, $prefix = null) {
        if(!empty($file)){
            if (is_array($file)) {
                foreach ($file as $item) {
                    $dirFile = UPLOAD_PATH . $file . '/' . $item;
                    @unlink($dirFile);
                    $dirFile = UPLOAD_PATH . $file . '/' . $prefix . '-' . $item;
                    @unlink($dirFile);
                }
            } else {
                if(file_exists($file)){
                    @unlink($file);
                }
            }
        }


    }
}
?>
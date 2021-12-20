<?php
require_once 'public/phpThumb/ThumbLib.inc.php';
class Upload {
    public function uploadFile($file, $folder, $width = null, $height = null, $option = null) {
        if ($option == null) {
            if ($file['tmp_name'] != null) {
                $uploadDir = 'public/upload/' . $folder . '/';
                if (!file_exists('public/upload/' . $folder)) {
                    mkdir('public/upload/' .$folder, 0777, true);
                }
                try {
                    $fileName = $uploadDir . bin2hex(random_bytes(10)) . '.' .pathinfo(basename($file["name"]), PATHINFO_EXTENSION);
                } catch (Exception $e) {
                    echo $e->getMessage();
                }

                copy($file['tmp_name'], $fileName);
                if ($height != null && $width != null){
                    $thum = PhpThumbFactory::create($fileName);
                    $thum->adaptiveResize($width, $height);
                    $thum->save($uploadDir . $file['name']);
                }
                return '/'.$fileName;
            }
        }
    }
    public function getUrlFile($file, $folder, $width = 300, $height = 300, $option = null) {
        if ($option == null) {
            if ($file['tmp_name'] != null) {
                $uploadDir = 'public/upload/' . $folder . '/';
                if (!file_exists('public/upload/' . $folder)) {
                    mkdir('public/upload/' .$folder, 0777, true);
                }
                try {
                    $fileName = $uploadDir . bin2hex(random_bytes(10)) . '.' .pathinfo(basename($file["name"]), PATHINFO_EXTENSION);
                } catch (Exception $e) {
                    echo $e->getMessage();
                }

                copy($file['tmp_name'], $fileName);
//                if ($height != null && $width != null){
//                    $thum = PhpThumbFactory::create($fileName);
//                    $thum->adaptiveResize($width, $height);
//                    $thum->save($uploadDir . $file['name']);
//                }
                return '/'.$fileName;
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
            if(file_exists($arrfile)){
                @unlink($arrfile);
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
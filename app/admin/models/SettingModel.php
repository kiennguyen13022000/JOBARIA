<?php

class SettingModel extends Model
{
    public function form($arrParams){

        $this->SetTable('configs');
        if (!empty($arrParams['footer_logo']['name'])){
            $info = $this->getInfoImg('footer_logo');
            $uploadObj = new Upload();
            if (!empty($info['footer_logo'])){
                $uploadObj->removeFile('logo', null, $info['footer_logo']);
            }

            $arrParams['footer_logo'] = $uploadObj->uploadFile($arrParams['footer_logo'], 'logo');
        }else{
            unset($arrParams['footer_logo']);
        }
        if (!empty($arrParams['header_logo']['name'])){
            $info = $this->getInfoImg('header_logo');
            $uploadObj = new Upload();
            if (!empty($info['header_logo'])){
                $uploadObj->removeFile('logo', null, $info['header_logo']);
            }
            $arrParams['header_logo'] = $uploadObj->uploadFile($arrParams['header_logo'], 'logo');
        }else{
            unset($arrParams['header_logo']);
        }
        $arrParams = $this->prepare($arrParams);
        $ud = 0;
        foreach ($arrParams as $key => $value) {
            $query = "select * from `configs` where `config_name` = '$key'";
            if ($this->isExists($query)){
                $this->Update(['config_value' => $value], [["config_name", $key, '']]);
                $ud++;
            }else{
                $this->Insert(['config_name' => $key, 'config_value' => $value]);
            }
        }
        return $ud;
    }

    public function getInfoImg($img){
        $query = "select * from `configs` where `config_name` = '$img'";
        return $this->OneRecord($query);
    }

    public function getConfig(){
        $query = "select * from `configs`";
        $result = $this->ListRecord($query);
        $newResult = array();
        foreach ($result as $key => $value){
            $newResult[$value['config_name']] = $value['config_value'];
        }
        return $newResult;
    }

}
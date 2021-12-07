<?php
class Helper{

    public static function formatDate($date, $format){
        $result = '';
        if(!empty($date) && $date != '0000-00-00'){
            $result = date($format, strtotime($date));
        }
        return $result;
    }

    public static function cmsRadio($name, $type, $val, $checked = null){
        $radio = '<div class="custom-control custom-radio">
                           <input type="radio" id="'. $name .''. $val .'" name="'. $name .'"
                                   class="custom-control-input" '.$checked.'>
                            <label class="custom-control-label" for="'. $name .''. $val .'">'. $type .'</label>
                        </div>';


        return $radio;
    }

    public static function cmsSelectBox($name, $class, $arrData, $keySelect = 'default'){
        $xhtml = '<select name="'.$name.'" class="'.$class.'">';
        foreach ($arrData as $key => $value) {
            if($key == $keySelect && is_numeric($keySelect))
                $xhtml .= '<option selected value="'.$key.'">'.$value.'</option>';
            else $xhtml .= '<option value="'.$key.'">'.$value.'</option>';
        }
        $xhtml .= '</select>' ;
        return $xhtml;
    }


    public static function cmsMessage($message, $type){
        $strMessage = '';
        if(!empty($message)){
            if($type == 'is-valid'){
                $strMessage .= '<div class="valid-feedback">
                                    '. $message .'
                                </div>';
            }else{
                $strMessage .= '<div class="invalid-feedback">
                                    '. $message .'
                                </div>';
            }

        }
        return $strMessage;
    }

    public static function cmsFormGroup($arrlabel, $type, $name, $value = null, $class  = null, $size  = null, $required = 'required', $formGroup){
        $label = '<label for="'. $arrlabel['id'] .'">'. $arrlabel['label'] .'</label>';
        $strHtml = "<input type='$type' name='form[$name]' id='$arrlabel[id]' value='$value' class='$class' size='$size' placeholder='$arrlabel[label]' $required>" ;

        $label_input = $label . $strHtml;
        $htmlFormGroup = '<div class="'. $formGroup .'">
                        '. $label_input .'
                    </div>';

        return $htmlFormGroup;
    }

    public static function cmsFormGroupFile($arrlabel, $type, $name, $value = null, $class  = null, $size  = null, $required = 'required', $formGroup){
        $placeholder = ucfirst($name);
        $label1 = '<label for="'. $arrlabel['id'] .'">'. $arrlabel['label'] .'</label>';
        $strHtml = "<input type='$type' name='form[$name]' id='$arrlabel[id]' value='$value' class='$class' size='$size' placeholder='$placeholder' $required>" ;

        $groupFile = '<div class="custom-file">
                           '. $strHtml .' 
                           <label class="custom-file-label" for="'.$arrlabel['id'].'">Choose file</label>
                        </div>';
        $label_input = $label1 . $groupFile;
        $htmlFormGroup = '<div class="'. $formGroup .'">
                        '. $label_input .'
                    </div>';

        return $htmlFormGroup;
    }
    // create admin
    public static function cmsRow($formGroup){
        $xhtml = '<div class="form-row">
                    '. $formGroup .'
                  </div>';
        return $xhtml;
    }
}
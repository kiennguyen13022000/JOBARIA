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
        $checked = $val == $checked ? 'checked' : '';
        $radio = '<div class="custom-control custom-radio">
                           <input value="'. $val .'" type="radio" id="'. $name .''. $val .'" name="form['. $name .']"
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
        if($type == 'is-valid'){
            $strMessage .= '<div class="valid-feedback">
                                Good
                            </div>';
        }else{
            $strMessage .= '<div class="invalid-feedback">
                                '. $message .'
                            </div>';
        }
        return $strMessage;
    }

    public static function cmsFormGroup($arrlabel, $type, $name, $value = null, $class  = null, $size  = null, $required, $formGroup, $errors){
        $star = empty($required) ? '' : '<span class="text-danger">*</span>';
        $label = '<label for="'. $arrlabel['id'] .'">'. $arrlabel['label'] .'</label>' . $star;
        $resultInput = '';
        $resultFeedback = '';
        if(isset($errors)){
            if($required == true && isset($errors[$name])){
                $resultInput    .= empty($errors[$name]) ? 'is-valid' : ' is-invalid';
                $resultFeedback .= self::cmsMessage($errors[$name], $resultInput);
                $class .= ' ' . $resultInput;
            }
        }


        $strHtml = "<input type='$type' name='form[$name]' id='$arrlabel[id]' value='$value' class='$class' size='$size' placeholder='$arrlabel[label]'>" ;
        $label_input = $label . $strHtml;
        $htmlFormGroup = '<div class="'. $formGroup .'">
                        '. $label_input . $resultFeedback .'  
                    </div>';

        return $htmlFormGroup;
    }
    public static function cmsTextFormGroup($arrlabel, $type, $name, $value = null, $class  = null, $size  = null, $required = 'required', $formGroup){
      $label = '<label for="'. $arrlabel['id'] .'">'. $arrlabel['label'] .'</label>';
      $strHtml = "<textarea  name='form[$name]'  cols='30' rows='10' id='$arrlabel[id]' value='$value' class='$class' size='$size' placeholder='$arrlabel[label]' $required></textarea>" ;
      $label_input = $label . $strHtml;
      $htmlFormGroup = '<div class="'. $formGroup .'">
                      '. $label_input .'
                  </div>';

      return $htmlFormGroup;
  }

    public static function cmsFormGroupFile($arrlabel, $type, $name, $value = null, $class  = null, $size  = null, $required = 'required', $formGroup, $errors, $folder = null, $task = 'add'){
        $placeholder = ucfirst($name);
        $label1 = '<label for="'. $arrlabel['id'] .'">'. $arrlabel['label'] .'</label>'  ;
        $resultInput = '';
        $resultFeedback = '';

        if(isset($errors[$name])){
            $resultInput    .= empty($errors[$name]) ? 'is-valid' : ' is-invalid';
            $resultFeedback .= self::cmsMessage($errors[$name], $resultInput);
            $class .= ' ' . $resultInput;
        }
        if (is_array($value))
            $value = '';
        $strHtml = "<input type='$type' name='$name' id='$arrlabel[id]' value='$value' class='$class' size='$size' placeholder='$placeholder' $required>" ;

        $img = '<img src="'. $value .'" class="preview__avatar ">';
        if($task == 'edit'){
            $src = 'public/upload/' . $folder . DS . $value;
            $img = '<img src="'. $src .'" class="preview__avatar border rounded mt-2" width="100" height="130">';
            $inputHidden = '<input class="d-none" type="text" value="'. $value .'" name="form[avartar]">';
            $img .= $inputHidden;
        }

        $groupFile = '<div class="custom-file">
                           '. $strHtml .' 
                           <label class="custom-file-label" for="'.$arrlabel['id'].'">Choose file</label>
                           '. $resultFeedback .'
                        </div>';
        $label_input = $label1 . $groupFile;
        $htmlFormGroup = '<div class="'. $formGroup .'">
                        '. $label_input . $img.'
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
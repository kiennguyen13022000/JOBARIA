<?php
class Validate{

    // Error array
    private $errors	= array();

    // Source array
    private $source	= array();

    // Rules array
    private $rules	= array();

    // Result array
    private $result	= array();

    // Contrucst
    public function __construct($source){
        if(array_key_exists('submit', $source)) unset($source['submit']);
        if(array_key_exists('token', $source)) unset($source['token']);
        $this->prepare($source);
    }
    public function getSource(){
        return $this->source;
    }
    private function prepare($source){
        foreach ($source as $key => $value){
            $source[$key] = htmlspecialchars($value);
        }
       $this->source = $source;

    }

    // Add rules
    public function addRules($rules){
        $this->rules = array_merge($rules, $this->rules );
    }

    // Get error
    public function getError(){
        return $this->errors;
    }
    public function setError($data, $ele){
        $this->errors[$ele] = $data;
    }
    // Get result
    public function getResult(){
        return $this->result;
    }

    // Add rule
    public function addRule($element, $type, $options = null, $required = true){
        $this->rules[$element] = array('type' => $type, 'options' => $options, 'required' => $required);
        return $this;
    }

    // Run
    public function run(){

        foreach($this->rules as $element => $value){
            if(isset($this->getError()[$element]))
                unset($this->source[$element]);
            if($value['required'] == true && trim($this->source[$element]) == null){
                $this->errors[$element] = ucfirst($element) . ' is not empty!';
            }else{

                    switch ($value['type']) {
                        case 'int':
                            $this->validateInt($element, $value['options']['min'], $value['options']['max']);
                            break;
                        case 'int_min':
                            $this->validateIntMin($element, $value['options']['min']);
                            break;
                        case 'int_max':
                            $this->validateIntMax($element, $value['options']['max']);
                            break;
                        case 'min':
                            $this->validateMin($element, $value['options']['min']);
                            break;
                        case 'max':
                            $this->validateMax($element, $value['options']['max']);
                            break;
                        case 'string-between':
                            $this->validateStringBetween($element, $value['options']);
                            break;
                        case 'url':
                            $this->validateUrl($element);
                            break;
                        case 'email':
                            $this->validateEmail($element);
                            break;
                        case 'password':
                            $this->validatePassword($element, $value['options']);
                            break;
                        case 'old-password':
                            $this->validatePasswordIsExists($element, $value['options']);
                            break;
                        case 'phone':
                            $this->validatePhone($element, $value['options']);
                            break;
                        case 'confirm_password':
                            $this->validateConfirmPassword($element);
                            break;
                        case 'date':
                            $this->validateBirthday($element, $value['options']['min']);
                            break;
                        case 'status':
                            $this->validateStatus($element, $value['options']);
                            break;
                        case 'existsRecord':
                            $this->validateRecord($element, $value['options']);
                            break;
                        case 'notExistsRecord':
                            $this->validateNotExistsRecord($element, $value['options']);
                            break;
                        case 'file':
                            $this->validateFile($element, $value['options']);
                            break;
                        case 'string-notExistsRecord':
                            $this->validateNotExistsRecord($element, $value['options']);
                            $this->validateMin($element, $value['options']['min']);
                            break;
                        case 'email-notExistsRecord':
                            $this->validateNotExistsRecord($element, $value['options']);
                            $this->validateEmail($element);
                            break;
                    }
            }
            if(!array_key_exists($element, $this->errors)) {
                $this->result[$element] = $this->source[$element];
            }
        }
        $eleNotValidate = array_diff_key($this->source, $this->errors);
        $this->result	= array_merge($this->result, $eleNotValidate);

    }

    // Validate Integer
    private function validateInt($element, $min = 0, $max = 0){
        if(!filter_var($this->source[$element], FILTER_VALIDATE_INT, array("options"=>array("min_range"=>$min,"max_range"=>$max)))){
            $this->errors[$element] = "'" . $this->source[$element] . "' phải từ 3 ký tự";
        }
    }
    // Validate Integer Min
    private function validateIntMin($element, $min){
        if($this->source[$element] < $min ){
            $this->errors[$element] = "'" . $element . "' phải lớn hơn hoặc bằng ".$min."";
        }
    }
    // Validate Integer Min
    private function validateIntMax($element, $max){
        if($this->source[$element] > $max ){
            $this->errors[$element] = "'" . $element . "' phải nhỏ hơn hoặc bằng ".$max."";
        }
    }


    // Validate Min
    private function validateMin($element, $min = 0){
        $length = strlen($this->source[$element]);
        if($length < $min) {
            $this->errors[$element] = ucfirst($element) . " must be at least ". $min ." characters!";
        }
    }

    // Validate Max
    private function validateMax($element, $max = 0){
        $length = strlen($this->source[$element]);
        if($length > $max){
            $this->errors[$element] = ucfirst($element) . " must be less than ". $max ." characters";
        }
    }
//    Validate string between
    private function validateStringBetween($element, $option){
        if(mb_strlen($this->source[$element]) < $option['min'] || mb_strlen($this->source[$element]) > $option['max'] ){
            $this->errors[$element] = ucfirst($element) . " must be between ". $option['min'] . ' and ' . $option['max'] ." characters";
        }
    }
    // Validate URL
    private function validateURL($element){
        if(!filter_var($this->source[$element], FILTER_VALIDATE_URL)){
            $this->errors[$element] = "'" . $this->source[$element] . "' is an invalid url";
        }
    }

    // Validate Email
    private function validateEmail($element){
        if(!filter_var($this->source[$element], FILTER_VALIDATE_EMAIL)){
            $this->errors[$element] = ucfirst($element) . " is an invalid email";
        }
    }
    private function validatePassword($element, $option){
        $pattern = "#^(?=.*\d)(?=.*[A-Z])(?=.*\W).{8,8}$#";
        if($option['action'] == 'add' || ($option['action'] == 'edit' && $this->source[$element]!= null)){
            if(!preg_match($pattern, $this->source[$element])){
                $this->errors[$element] = $element. " is an invalid password";
            }
        }
    }
    private function validatePhone($element, $option){
        $pattern = "#^[0-9]{10,10}$#";
        if(!preg_match($pattern, $this->source[$element])){
            $this->errors[$element] = $element. " is an invalid phone";
        }
    }
    private function validateConfirmPassword($element){
         if(!isset($this->errors['password'])){
             if($this->result['password'] != $this->source[$element])
                 $this->setError(ucfirst($element) . ' does not match!', $element);
         }else{
             $this->setError(ucfirst($element) . ' does not match!', $element);
         }
    }

    public function validateStatus($ele, $arrDeny ){
        if(in_array($this->source[$ele], $arrDeny['deny']) == true){
            $this->errors[$ele] = "Vui lòng chọn giá trị khác giá trị mặc định";
            return false;
        }
        return true;
    }

    public function validateBirthday($ele, $day){
        $day = date_parse_from_format('d/m/Y', $day);
        $day = mktime(0,0,0,$day['month'], $day['day'], $day['year']);

        $current = date_parse_from_format('y/m/Y', $this->source['birthday']);
        $current = mktime(0,0,0,$current['month'], $current['day'], $current['year']);
        if($day > $current){
            $this->errors[$ele] = "'" . $this->source[$ele] . "' is an invalid birthday";
        }

        return true;
    }

    public function isValid(){
        if(count($this->errors) > 0){
            return false;
        }
        return true;
    }
    public function validateRecord($element, $data){
        $db = $data['database'];
        $query = $data['query'];
        if($db->isExists($query) == false){
            $this->errors[$element] = "'". $this->source[$element] . "'" . ' chua tồn tại';
            return false;
        }

        return true;
    }

    public function validateNotExistsRecord($element, $data){
        $db = $data['database'];
        $query = $data['query'];
        if($db->isExists($query) == true){
            $this->errors[$element] = ucfirst($element) . ' này đã tồn tại!';
        }
    }
    public function validatePasswordIsExists($element, $data){
        $db = $data['database'];
        $query = $data['query'];
        if($db->isExists($query) == false){
            $this->errors[$element] = 'Old password is incorrect!';
        }
    }
    private function validateFile($element, $options){
        if(!empty($this->source[$element]['name'])){
//            if(!filter_var($this->source[$element]['size'], FILTER_VALIDATE_INT, array("options"=>array("min_range"=>$options['min'],"max_range"=>$options['max'])))){
//                $this->setError($element, 'kích thước không phù hợp!');
//            }
            $ext = pathinfo($this->source[$element]['name'], PATHINFO_EXTENSION);
            if(in_array($ext, $options['extension']) == false){
                $this->setError('phần mở rộng không phù hợp!', $element);
            }
        }
    }
}
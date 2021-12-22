<?php
class Model{
    protected $connect;
    protected $database;
    protected $table;
    protected $resultQuery;

    // set constractor
    function __construct($param = null){
        if($param == null){
            $param['server'] = DB_HOST;
            $param['user'] = DB_USER;
            $param['password'] = DB_PASS;
            $param['table'] = DB_TABLE;
            $param['database'] = DB_NAME;
        }
        $link = mysqli_connect($param['server'], $param['user'], $param['password']);
        if(!$link){
            echo 'fail connect';
            echo mysqli_errno($link);
        }else{

            $this->connect = $link;
            $this->database = $param['database'];
            $this->table = $param['table'];
            $this->SetDatabase();
        }
    }

    // set database

    public function SetDatabase($database = null){
        if($database != null){
            $this->database = $database;
        }
        mysqli_select_db($this->connect,$this->database);
    }

    //set connect

    public function SetConnect($connect){
        $this->connect = $connect;
    }
    public function GetConnect(){
        return $this->connect ;
    }
    public function SetTable($table){
        $this->table = $table;
    }

    public function __destruct(){
        mysqli_close($this->connect);
    }

    public function Query($sql){
//        echo $sql; die();
        $result = mysqli_query($this->connect, $sql);
        $this->resultQuery = $result;

    }

    // insert
    private function CreateInsert($arrData){
        $cols = '';
        $vals = '';
        foreach($arrData as $key => $value){
            $cols .= ", `$key`";
            $vals .= ", '$value'";
        }
        $query['cols'] = substr($cols, 2);
        $query['vals'] = substr($vals, 2);
        return $query;
    }
    public function prepare($arrParam){
        foreach ($arrParam as $key => $value){
            $arrParam[$key] = mysqli_real_escape_string($this->connect, $value);
        }
        return $arrParam;
    }
    public function Insert($param, $type = 'single'){
        if($type == 'single'){
            $newQuery = $this->CreateInsert($param);
            $sql = "insert into `$this->table`(".$newQuery['cols'] .") values(". $newQuery['vals'] .")";
            $this->Query($sql);
            return $this->LastId();
        }else if($type == 'multiple'){
            foreach ($param as $key => $value) {
                $newQuery = $this->CreateInsert($value);
                $sql = "insert into `$this->table`(".$newQuery['cols'] .") values(". $newQuery['vals'] .")";
                $this->Query($sql);
            }
        }
    }

    public function LastId(){
        return mysqli_insert_id($this->connect);
    }

    public function Update($param, $where){
        $ud = $this->CreateUpdate($param);
        $w = $this->CreateWhere($where);
        $sql = "update `$this->table` set $ud where $w";
        $this->Query($sql);
        return mysqli_affected_rows($this->connect);
    }

    // update
    public function affectedAction(){
        return mysqli_affected_rows($this->connect);
    }
    private function CreateUpdate($param){
        $str = '';
        foreach ($param as $key => $value) {
            $str .= ", `$key` = '$value'";
        }

        return substr($str, 2);
    }

    private function CreateWhere($where){

        foreach ($where as $key => $value) {
            $str[] = "`".$value[0]."` = '".$value[1]."'";
            $str[] = $value[2];
        }

        return trim(implode(' ', $str));
    }

    // delete

    public function Delete($where){
        $sql = "delete from `$this->table` where `id` in(".implode(',',$where).")";
        mysqli_query($this->connect, $sql);
        return mysqli_affected_rows($this->connect);
    }

    // select

    public function ListRecord($query){
        $this->Query($query);
        $result = array();
        if(mysqli_num_rows($this->resultQuery) > 0){
            while($row = mysqli_fetch_assoc($this->resultQuery))
                $result[] = $row;
        }
        mysqli_free_result($this->resultQuery);
        return $result;
    }

    public function OneRecord($sql){
        $this->Query($sql);
        $result = null;
        if(mysqli_num_rows($this->resultQuery) > 0){
            $result = mysqli_fetch_assoc($this->resultQuery);
        }
        mysqli_free_result($this->resultQuery);
        return $result;
    }

    public function fetchPairs($query){
        $result =array();
        if(!empty($query)){
            $this->Query($query);
            $arrData = $this->ListRecord();
            foreach ($arrData as $key => $value) {
                $result[$value['id']] = $value['name'];

            }
        }
        ksort($result);
        return $result;
    }

    public function isExists($query){

        if($query != null){
            $this->Query($query);
        }
        if(mysqli_num_rows($this->resultQuery) > 0)
        {
            return true;
        }
        return false;
    }

    public function totalItem($query){
        if($query != null){
            $this->Query($query);
            $result = $this->OneRecord();
        }
        return $result['total'] ;
    }

    public function lastPosition(){
        $query = 'select MAX(`position`) as max from `'. $this->table .'`';
        $result = $this->OneRecord($query);
        return $result['max'];
    }
    public function getMaxId(){
        $this->setTable('orders');
        $query = "SELECT max(id) as max FROM orders";
        $result = $this->OneRecord($query);
        return $result['max'] + 1;
    }
}
?>
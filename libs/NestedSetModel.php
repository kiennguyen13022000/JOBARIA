<?php
class NestedSetModel{
    private $table;
    public $parent_id;
    private $id;
    private $connect;
    private $data;
    public function __construct($table){
        $link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if($link)
        {
            $this->connect = $link;
            $this->setTable($table);
        }

    }

    public function setTable($table)
    {
        $this->table = $table;
    }

    public function removeNode($id, $option = 'branch')
    {
        $this->id = $id;
        if($option == 'branch') return $this->removeBranch();
        if($option == 'one') $this->removeOne();
    }

    public function removeBranch()
    {
        $nodeRemoveInfo = $this->getNodeInfo($this->id);
        $width = $this->widthNode($nodeRemoveInfo['left'], $nodeRemoveInfo['right']);

         $sqlDelete = 'delete from '. $this->table .' where `left` between '.$nodeRemoveInfo['left'].' and '.$nodeRemoveInfo['right'].' ';
         mysqli_query($this->connect, $sqlDelete);
         $affected = mysqli_affected_rows($this->connect);

         $sqlLeftTree = 'update '. $this->table .' set `left` = (`left` - '. $width .') where `left` > '. $nodeRemoveInfo['right'] .'';
         mysqli_query($this->connect, $sqlLeftTree);

         $sqlRightTree = 'update '. $this->table .' set `right` = (`right` - '. $width .') where `right` > '. $nodeRemoveInfo['right'] .'';
         mysqli_query($this->connect, $sqlRightTree);

         return $affected;
    }

    public function removeOne()
    {
        $nodeMoveInfo = $this->getNodeInfo($this->id);

         $sqlSelectNode = 'select * from '. $this->table .' where `parent_id` = '. $this->id .'';
        $result = mysqli_query($this->connect, $sqlSelectNode);

        $childs = array();
        while($row = mysqli_fetch_assoc($result)){
            $childs[] = $row['id'];
        }

        if(count($childs) > 0){
            foreach($childs as $value){
                $option['position'] = 'before';
                $option['brother_id'] = $nodeMoveInfo['id'];
                $this->moveNode($value, $nodeMoveInfo['parent_id'],  $option);
            }
        }
        $this->removeNode($nodeMoveInfo['id']);
    }

    public function updateNode($id, $newParentId = 0)
    {
        if($newParentId != 0){
            $option['position'] = 'left';
            $this->moveNode($id, $newParentId, $option);
        }

    }

    public function insertNode($parent = 1, $option = null)
    {
        $this->parent_id = $parent;

        if($option == null){
           return $this->insertRight();
        }else if($option['position'] == 'left'){
            $this->insertLeft();
        }else if ($option['position'] == 'before'){
            $this->insertBefore($option['brother_id']);
        }else{
            $this->insertAfter($option['brother_id']);
        }
    }

    public function insertRight()
    {
        $parentInfo = $this->getNodeInfo($this->parent_id);
        $parentRight = $parentInfo['right'];

        $updateLeft = 'update '. $this->table .' set `left` = (`left` + 2) where `left` > '. $parentRight .'';
        mysqli_query($this->connect, $updateLeft);

        $updateRight = 'update '. $this->table .' set `right` = (`right` + 2) where `right` >= '. $parentRight .'';
        mysqli_query($this->connect, $updateRight);

        $data['parent_id'] = $this->parent_id;
        $data['left'] =  $parentRight;
        $data['right'] = $parentRight + 1;
        $data['level'] = $parentInfo['level'] + 1;

        return $data;
    }

    private function createInsertQuery($data){
        $cols = '';
        $values = '';

        foreach ($data as $key => $value) {
            $cols       .= '`' . $key . '`,';
            $values     .= '\'' . $value .  '\',';
        }

        $cols   = substr($cols, 0, strlen($cols) - 1);
        $values = substr($values, 0, strlen($values) - 1);

        return 'insert into '. $this->table .'('. $cols .') values('. $values .')';
    }

    public function insertLeft()
    {
        $parentInfo = $this->getNodeInfo($this->parent_id);
        $parentLeft = $parentInfo['left'];

        $newLeft = $parentLeft + 1;
        $updateLeft = 'update '. $this->table .' set `left` = (`left` + 2) where `left` >= '.  $newLeft .'';

        mysqli_query($this->connect, $updateLeft);

        $updateRight = 'update '. $this->table .' set `right` = (`right` + 2) where `right` >= '. $newLeft .'';
        mysqli_query($this->connect, $updateRight);

        $data = $this->data;
        $data['parent_id'] = $this->parent_id;
        $data['left'] =  $parentLeft + 1;
        $data['right'] = $parentLeft + 2;
        $data['level'] = $parentInfo['level'] + 1;

        $sqlUpdate = $this->createInsertQuery($data);

        mysqli_query($this->connect, $sqlUpdate);
    }

    public function insertBefore($brother_id)
    {
        $parentInfo = $this->getNodeInfo($this->parent_id);
        $brotherInfo = $this->getNodeInfo($brother_id);
        $brotherLeft = $brotherInfo['left'];

        $updateLeft = 'update '. $this->table .' set `left` = (`left` + 2) where `left` >= '.  $brotherLeft .'';

        mysqli_query($this->connect, $updateLeft);

        $updateRight = 'update '. $this->table .' set `right` = (`right` + 2) where `right` > '. $brotherLeft .'';
        mysqli_query($this->connect, $updateRight);

        $data = $this->data;
        $data['parent_id'] = $brotherInfo['parent_id'];
        $data['left'] =  $brotherLeft;
        $data['right'] = $brotherLeft + 1;
        $data['level'] = $brotherInfo['level'];

        $sqlUpdate = $this->createInsertQuery($data);

        mysqli_query($this->connect, $sqlUpdate);
    }

    public function insertAfter($brother_id)
    {
        $parentInfo = $this->getNodeInfo($this->parent_id);
        $brotherInfo = $this->getNodeInfo($brother_id);
        $brotherRight = $brotherInfo['right'];

        echo $updateLeft = 'update '. $this->table .' set `left` = (`left` + 2) where `left` > '.  $brotherRight .'';

        echo '<br />';
        mysqli_query($this->connect, $updateLeft);

        echo $updateRight = 'update '. $this->table .' set `right` = (`right` + 2) where `right` > '. $brotherRight .'';
        echo '<br />';
        mysqli_query($this->connect, $updateRight);

        $data = $this->data;
        $data['parent_id'] = $brotherInfo['parent_id'];
        $data['left'] =  $brotherRight + 1;
        $data['right'] = $brotherRight + 2;
        $data['level'] = $brotherInfo['level'];

        echo $sqlUpdate = $this->createInsertQuery($data);

        mysqli_query($this->connect, $sqlUpdate);
    }

    public function getNodeInfo($id)
    {
        $sql = 'select * from '.$this->table.' where id = '. $id .'';
        $result = mysqli_query($this->connect, $sql);

        $row = mysqli_fetch_assoc($result);
        return $row;

    }

    public function moveNode($id, $parent_id, $option = null)
    {
        $this->id = $id;
        $this->parent_id = $parent_id;

        if($option['position'] == 'right' || $option == null){
            $this->moveRight();
        }else if($option['position'] == 'left'){
            $this->moveLeft();
        }else if ($option['position'] == 'before'){
            $this->moveBefore($option['brother_id']);
        }else if ($option['position'] == 'after'){
            $this->moveAfter($option['brother_id']);
        }
    }

    private function moveRight()
    {
        /**
         * ======================= lấy thông tin node cần di chuyển===================================
         */
        $nodeMoveInfo = $this->getNodeInfo($this->id);
        /**
         * ======================= 1 tách nhánh ra khỏi cây(tách left và right)===================================
         */
        $updateNodeMove =   'update '. $this->table .' 
                                set `left`  = (`left` - '.$nodeMoveInfo['left'].'),
                                    `right` =  (`right` - '.$nodeMoveInfo['right'].') 
                                where `left` between '.$nodeMoveInfo['left'].' and '.$nodeMoveInfo['right'].'';
        mysqli_query($this->connect, $updateNodeMove);
        /**
         * ======================= 2 tính độ dài khoảng giá trị của node cần di chuyển===================================
         */
         $widthNodeMove = $this->widthNode($nodeMoveInfo['left'], $nodeMoveInfo['right']);
        /**
         * ======================= 3 cập nhật lại các nhánh bên phải của node cần di chuyển===================================
         */
        $updateLeft = 'update '. $this->table .' set `left` = (`left` - '. $widthNodeMove .') where `left` > '. $nodeMoveInfo['right'] .'';
        mysqli_query($this->connect, $updateLeft);

        $updateRight = 'update '. $this->table .' set `right` = (`right` - '. $widthNodeMove .') where `right` > '. $nodeMoveInfo['right'] .'';
        mysqli_query($this->connect, $updateRight);

        /**
         * ======================= 4 lấy thông tin node cha===================================
         */

        $parentInfo = $this->getNodeInfo($this->parent_id);

        /**
         * ======================= 5 cập nhật lại các nhánh bên phải node được gắn vào===================================
         */
        $updateLeftParentNode  = 'update '. $this->table .' set `left` = (`left` + '. $widthNodeMove .') where `left` > '. $parentInfo['left'] .'';
        mysqli_query($this->connect, $updateLeftParentNode);

        $updateRightParentNode  = 'update '. $this->table .' set `right` = (`right` + '. $widthNodeMove .') where `right` > '. $parentInfo['left'] .'';
        mysqli_query($this->connect, $updateRightParentNode);
        /**
         * ======================= 6 update level cho node di chuyển===================================
         */
        $updateLevel = 'update '. $this->table .' set `level` = (`level` - '. $nodeMoveInfo['level'] .' + 1 + '. $parentInfo['level'] .') where `right` <= 0';
        mysqli_query($this->connect, $updateLevel);
        /**
         * ======================= 7 cập nhật lại các nhánh của node di chuyển===================================
         */
        $newUpdateLeftNodeMove = 'update '. $this->table .' set `left` = (`left` + '. $parentInfo['right'] .') where `right` <= 0';
        mysqli_query($this->connect, $newUpdateLeftNodeMove);

        $rightNode = $parentInfo['right'] + $widthNodeMove - 1;
        $newUpdateRightNodeMove = 'update '. $this->table .' set `right` = (`right` + '. $rightNode .') where `right` <= 0';
        mysqli_query($this->connect, $newUpdateRightNodeMove);

        /**
         * ======================= 8 cập nhật parent_id chop node di chuyển===================================
         */

        $updateId = 'update '. $this->table .' set `parent_id` = '. $this->parent_id.' where `id` = '.$this->id.'';
        mysqli_query($this->connect, $updateId);
    }

    private function widthNode($leftMoveNode, $rightMoveNode){
        return $rightMoveNode - $leftMoveNode + 1;
    }

    private function moveLeft()
    {
        $nodeMoveInfo = $this->getNodeInfo($this->id);
        /**
         * ======================= 1 tách nhánh ra khỏi cây(tách left và right)===================================
         */

         $updateNodeMove =   'update '. $this->table .' 
                                 set `left`  = (`left` - '.$nodeMoveInfo['left'].'),
                                     `right` =  (`right` - '.$nodeMoveInfo['right'].') 
                                 where `left` between '.$nodeMoveInfo['left'].' and '.$nodeMoveInfo['right'].'';
        mysqli_query($this->connect, $updateNodeMove);
        /**
         * ======================= 2 tính độ dài khoảng giá trị của node cần di chuyển===================================
         */
        $widthNodeMove = $this->widthNode($nodeMoveInfo['left'], $nodeMoveInfo['right']);
        /**
         * ======================= 3 cập nhật lại các nhánh bên phải của node cần di chuyển===================================
         */
         $updateLeft = 'update '. $this->table .' set `left` = (`left` - '. $widthNodeMove .') where `left` > '. $nodeMoveInfo['right'] .'';
         mysqli_query($this->connect, $updateLeft);

         $updateRight = 'update '. $this->table .' set `right` = (`right` - '. $widthNodeMove .') where `right` > '. $nodeMoveInfo['right'] .'';
         mysqli_query($this->connect, $updateRight);

        /**
         * ======================= 4 lấy thông tin node cha===================================
         */

        $parentInfo = $this->getNodeInfo($this->parent_id);

        /**
         * ======================= 5 cập nhật lại các nháh bên phải node được gắn vào===================================
         */
        $updateLeftParentNode  = 'update '. $this->table .' set `left` = (`left` + '. $widthNodeMove .') where `left` > '. $parentInfo['left'] .' and `right` > 0';
        mysqli_query($this->connect, $updateLeftParentNode);

        $updateRightParentNode  = 'update '. $this->table .' set `right` = (`right` + '. $widthNodeMove .') where `right` > '. $parentInfo['left'] .' and `right` > 0';
        mysqli_query($this->connect, $updateRightParentNode);

        /**
         * ======================= 6 update level cho node di chuyển===================================
         */
        $updateLevel = 'update '. $this->table .' set `level` = (`level` - '. $nodeMoveInfo['level'] .' + 1 + '. $parentInfo['level'] .') where `right` <= 0';
        mysqli_query($this->connect, $updateLevel);

        /**
         * ======================= 7 cập nhật lại các nhánh của node di chuyển===================================
         */
        $newUpdateLeftNodeMove = 'update '. $this->table .' set `left` = (`left` + '. $parentInfo['left'] .' + 1) where `right` <= 0';
        mysqli_query($this->connect, $newUpdateLeftNodeMove);

        $leftNode = $parentInfo['left'] + $widthNodeMove;
        $newUpdateRightNodeMove = 'update '. $this->table .' set `right` = (`right` + '. $leftNode .') where `right` <= 0';
        mysqli_query($this->connect, $newUpdateRightNodeMove);
        /**
         * ======================= 8 cập nhật parent_id chop node di chuyển===================================
         */
        $updateId = 'update '. $this->table .' set `parent_id` = '. $this->parent_id.' where `id` = '.$this->id.'';
        mysqli_query($this->connect, $updateId);

    }

    private function moveBefore($brother_id)
    {
        $nodeMoveInfo = $this->getNodeInfo($this->id);

        /**
         * ======================= 1 tách nhánh ra khỏi cây(tách left và right)===================================
         */
        $updateNodeMoveRight =   'update '. $this->table .' 
                                 set `right` =  (`right` - '.$nodeMoveInfo['right'].') 
                                 where `left` between '.$nodeMoveInfo['left'].' and '.$nodeMoveInfo['right'].'';
        mysqli_query($this->connect, $updateNodeMoveRight);

        $updateNodeMoveRight=   'update '. $this->table .' 
                                 set `left` =  (`left` - '.$nodeMoveInfo['left'].') 
                                 where `left` between '.$nodeMoveInfo['left'].' and '.$nodeMoveInfo['right'].'';
        mysqli_query($this->connect, $updateNodeMoveRight);

        /**
         * ======================= 2 tính độ dài khoảng giá trị của node cần di chuyển===================================
         */

         $widthNodeMove = $this->widthNode($nodeMoveInfo['left'], $nodeMoveInfo['right']);


        /**
         * ======================= 3 cập nhật lại các nhánh bên phải của node cần di chuyển===================================
         */
         $updateLeft = 'update '. $this->table .' set `left` = (`left` - '. $widthNodeMove .') where `left` > '. $nodeMoveInfo['right'] .'';
        mysqli_query($this->connect, $updateLeft);


        $updateRight = 'update '. $this->table .' set `right` = (`right` - '. $widthNodeMove .') where `right` > '. $nodeMoveInfo['right'] .'';
        mysqli_query($this->connect, $updateRight);


        /**
         * ======================= 4 lấy thông tin node cha===================================
         */

        $parentInfo = $this->getNodeInfo($this->parent_id);

        $brotherNodeInfo = $this->getNodeInfo($brother_id);

        /**
         * ======================= 5 cập nhật lại các nhánh bên phải node được gắn vào===================================
         */
         $updateLeftParentNode  = 'update '. $this->table .' set `left` = (`left` + '. $widthNodeMove .') where `left` >= '. $brotherNodeInfo['left'] .' and `right` > 0';
        mysqli_query($this->connect, $updateLeftParentNode);


         $updateRightParentNode  = 'update '. $this->table .' set `right` = (`right` + '. $widthNodeMove .') where `right` > '. $brotherNodeInfo['left'] .' and `right` > 0';
        mysqli_query($this->connect, $updateRightParentNode);


        /**
         * ======================= 6 update level cho node di chuyển===================================
         */
         $updateLevel = 'update '. $this->table .' set `level` = (`level` - '. $nodeMoveInfo['level'] .' + 1 + '. $parentInfo['level'] .') where `right` <= 0';
        mysqli_query($this->connect, $updateLevel);



        /**
         * ======================= 7 cập nhật lại các nhánh của node di chuyển===================================
         */
         $newUpdateLeftNodeMove = 'update '. $this->table .' set `left` = (`left` + '. $brotherNodeInfo['left'] .') where `right` <= 0';
        mysqli_query($this->connect, $newUpdateLeftNodeMove);

        $leftNode = $brotherNodeInfo['left'] + $widthNodeMove - 1;
         $newUpdateRightNodeMove = 'update '. $this->table .' set `right` = (`right` + '. $leftNode .') where `right` <= 0';
        mysqli_query($this->connect, $newUpdateRightNodeMove);


        /**
         * ======================= 8 cập nhật parent_id chop node di chuyển===================================
         */

         $updateId = 'update '. $this->table .' set `parent_id` = '. $this->parent_id.' where `id` = '.$this->id.'';
        mysqli_query($this->connect, $updateId);

    }

    private function moveAfter($brother_id)
    {
        $nodeMoveInfo = $this->getNodeInfo($this->id);

        /**
         * ======================= 1 tách nhánh ra khỏi cây(tách left và right)===================================
         */

        $updateNodeMoveRight =   'update '. $this->table .' 
                                 set `right` =  (`right` - '.$nodeMoveInfo['right'].') 
                                 where `left` between '.$nodeMoveInfo['left'].' and '.$nodeMoveInfo['right'].'';
        mysqli_query($this->connect, $updateNodeMoveRight);

        $updateNodeMoveLeft =   'update '. $this->table .' 
                                 set `left` =  (`left` - '.$nodeMoveInfo['left'].') 
                                 where `left` between '.$nodeMoveInfo['left'].' and '.$nodeMoveInfo['right'].'';
        mysqli_query($this->connect, $updateNodeMoveLeft);

        /**
         * ======================= 2 tính độ dài khoảng giá trị của node cần di chuyển===================================
         */
         $widthNodeMove = $this->widthNode($nodeMoveInfo['left'], $nodeMoveInfo['right']);

        /**
         * ======================= 3 cập nhật lại các nhánh bên phải của node cần di chuyển===================================
         */
         $updateLeft = 'update '. $this->table .' set `left` = (`left` - '. $widthNodeMove .') where `left` > '. $nodeMoveInfo['right'] .'';
        mysqli_query($this->connect, $updateLeft);


         $updateRight = 'update '. $this->table .' set `right` = (`right` - '. $widthNodeMove .') where `right` > '. $nodeMoveInfo['right'] .'';
        mysqli_query($this->connect, $updateRight);


        /**
         * ======================= 4 lấy thông tin node cha===================================
         */

        $parentInfo = $this->getNodeInfo($this->parent_id);
        /**
         * ======================= lấy thông tin node anh em ===================================
         */
        $brotherNodeInfo = $this->getNodeInfo($brother_id);

        /**
         * ======================= 5 cập nhật lại các nhánh bên phải node được gắn vào===================================
         */
         $updateLeftParentNode  = 'update '. $this->table .' set `left` = (`left` + '. $widthNodeMove .') where `left` > '. $brotherNodeInfo['right'] .' and `right` > 0';
        mysqli_query($this->connect, $updateLeftParentNode);


         $updateRightParentNode  = 'update '. $this->table .' set `right` = (`right` + '. $widthNodeMove .') where `right` > '. $brotherNodeInfo['right'] .' and `right` > 0';
        mysqli_query($this->connect, $updateRightParentNode);


        /**
         * ======================= 6 update level cho node di chuyển===================================
         */
         $updateLevel = 'update '. $this->table .' set `level` = (`level` - '. $nodeMoveInfo['level'] .' + 1 + '. $parentInfo['level'] .') where `right` <= 0';
        mysqli_query($this->connect, $updateLevel);



        /**
         * ======================= 7 cập nhật lại các nhánh của node di chuyển===================================
         */
         $newUpdateLeftNodeMove = 'update '. $this->table .' set `left` = (`left` + '. $brotherNodeInfo['right'] .' + 1) where `right` <= 0';
        mysqli_query($this->connect, $newUpdateLeftNodeMove);


        $leftNode = $brotherNodeInfo['right'] + $widthNodeMove ;
         $newUpdateRightNodeMove = 'update '. $this->table .' set `right` = (`right` + '. $leftNode .') where `right` <= 0';
        mysqli_query($this->connect, $newUpdateRightNodeMove);


        /**
         * ======================= 8 cập nhật parent_id chop node di chuyển===================================
         */

         $updateId = 'update '. $this->table .' set `parent_id` = '. $this->parent_id.' where `id` = '.$this->id.'';
        mysqli_query($this->connect, $updateId);

    }

    public function moveUp($id)
    {
        $nodeMoveInfo = $this->getNodeInfo($id);
        $sqlSelectNode = 'select * from '. $this->table .' where `parent_id` = '. $nodeMoveInfo['parent_id'] .'
                             and `left` < '. $nodeMoveInfo['left'] .' order by `left` desc limit 1';

        $result = mysqli_query($this->connect, $sqlSelectNode);
        $row = mysqli_fetch_assoc($result);
        if(!empty($row)){

            $option['position'] = 'before';
            $option['brother_id'] = $row['id'];
            $this->moveNode($id, $nodeMoveInfo['parent_id'], $option);
        }
    }

    public function moveDown($id)
    {
        $nodeMoveInfo = $this->getNodeInfo($id);
        $sqlSelectNode = 'select * from '. $this->table .' where `parent_id` = '. $nodeMoveInfo['parent_id'] .'
                             and `left` > '. $nodeMoveInfo['right'] .' order by `left` asc limit 1';

        $result = mysqli_query($this->connect, $sqlSelectNode);
        $row = mysqli_fetch_assoc($result);
        if(!empty($row)){
            $option['position'] = 'after';
            $option['brother_id'] = $row['id'];
            $this->moveNode($id, $nodeMoveInfo['parent_id'], $option);
        }
    }


}

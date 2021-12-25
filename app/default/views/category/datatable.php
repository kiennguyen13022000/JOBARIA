<?php
$xhtml = '';

foreach ($this->data as $key => $value){
    $img = '';
    if($value['image'] != null){
        $img = '<img class="img__table" src="'. $value['image'] .'">';
    }
    $move = '';
    if($key == 0){
        continue;
//        $move .= '<i onclick="moveNode(\'down\', '.$value['id'].')" class="btnMove remixicon-arrow-down-circle-fill"></i>';
    }else if($value['left'] - 1 == $this->data[$key - 1]['left'] && $this->data[$key - 1]['id'] == $value['parent_id']){
        $move .= '<i onclick="moveNode(\'down\', '.$value['id'].')" class="btnMove-category remixicon-arrow-down-circle-fill"></i>';
    }else if(count($this->data) - 1 >= $key + 1 && $this->data[$key + 1]['left'] > $value['left'] + 2){
        $move .= '<i onclick="moveNode(\'up\', '.$value['id'].')" class="btnMove-category remixicon-arrow-up-circle-fill"></i>';
    }else {
        $move .= '<i onclick="moveNode(\'up\', '.$value['id'].')" class="btnMove-category remixicon-arrow-up-circle-fill"></i>';
        $move .= '<i onclick="moveNode(\'down\', '.$value['id'].')" class="btnMove-category remixicon-arrow-down-circle-fill"></i>';
    }

    if($key == count($this->data) - 1 || $value['right'] == $this->data[0]['right'] - 1){
        $move = '<i onclick="moveNode(\'up\', '.$value['id'].')" class="btnMove-category remixicon-arrow-up-circle-fill"></i>';
    }
    if(count($this->data) - 1 >= $key + 1 && $key > 1 && $this->data[$key - 1]['left'] == $value['left'] - 1 && ($this->data[$key + 1]['left'] > $value['left'] + 2 || $this->data[$key + 1]['left'] == $value['left'] + 1 )){
        $move = '';
    }
    if (count($this->data) - 1 == $key && $key > 1 && $value['parent_id'] == $this->data[$key - 1]['id'] && $this->data[$key - 1]['left'] == $value['left'] - 1){
        $move = '';
    }

    $status         = $value['status'] == 1 ? 'active' : 'deactive';
    $classStatus    = $value['status'] == 1 ? 'activeStatus' : 'deactive';
    $trending         = $value['trending'] == 1 ? 'active' : 'deactive';
    $classTrending    = $value['trending'] == 1 ? 'activeStatus' : 'deactive';
    $xhtml .= '<tr id="row-'. $value['id'] .'">
                                            <td class="d-none">'. $value['left'] .'</td>
                                            <td>'. $img. '</td>
                                            <td>'. $value['name'] .'</td>
                                            <td><span class="bg-primary rounded-circle px-1 text-white">'. $value['level'] .'</span></td>
                                            <td class="text-center">                                                 
                                                 '. $move .'
                                            </td>
                                            <td class="font-weight-bold">'. $value['parentName'] .'</td>
                                            <td>
                                                <span  data-control="category" data-id="'.$value['id'].'" data-trending="'.$value['trending'].'" class="trending__item '. $classTrending .'">'. ucfirst($trending) .'</span>
                                            </td>
                                            <td>
                                                <span  data-control="category" data-id="'.$value['id'].'" data-status="'.$value['status'].'" class="status__item '. $classStatus .'">'. ucfirst($status) .'</span>
                                            </td>
                                            <td>
                                                <ul class="list-inline table-action m-0">                
                                                    <li class="list-inline-item">
                                                        <a href="'. Url::createLink('admin', 'category', 'form', ['task' => 'edit', 'id' => $value['id']]) .'" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <a href="javascript:void(0)" onclick="deleteItem('. $value['id'] .', \'category\')" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>';
}

echo $xhtml;
//<td>'. $value['created_at'] .'</td>
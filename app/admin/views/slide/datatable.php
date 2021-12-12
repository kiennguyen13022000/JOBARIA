<?php
$xhtml = '';

foreach ($this->data as $key => $value){
    $move       = '';
    if ($key == 0){
        $move       .= '<i data-id="'.$value['id'].'" data-position="'.$value['position'].'" data-type="down" data-control="slide" class="btnMove remixicon-arrow-down-circle-fill"></i>';
    }else if ($key == count($this->data) - 1){
        $move       .= '<i data-id="'.$value['id'].'" data-position="'.$value['position'].'" data-type="up" data-control="slide" class="btnMove remixicon-arrow-up-circle-fill"></i>';
    }else{
        $move       .= '<i data-id="'.$value['id'].'" data-position="'.$value['position'].'" data-type="down" data-control="slide" class="btnMove remixicon-arrow-down-circle-fill"></i>';
        $move       .= '<i data-id="'.$value['id'].'" data-position="'.$value['position'].'" data-type="up" data-control="slide" class="btnMove remixicon-arrow-up-circle-fill"></i>';
    }

    $img = '';
    if($value['image'] != null){
        $img = '<img class="img__table__slide" src="'. $value['image'] .'">';
    }
    $status         = $value['status'] == 1 ? 'active' : 'deactive';
    $classStatus    = $value['status'] == 1 ? 'activeStatus' : 'deactive';
    $xhtml .= '<tr id="row-'. $value['id'] .'">
                                            <td class="d-none">'. $value['position'] .'</td>
                                            <td>'. $img .'</td>
                                            <td>'. $value['name'] .'</td>
                                            <td>'. $value['title_1'] .'</td>
                                            <td>'. $value['title_2'] .'</td>
                                            <td>'. $value['title_3'] .'</td>
                                            <td>'. $value['title_4'] .'</td>
                                            <td>'. $move .'</td>
                                            <td>
                                                <span title="Change" data-control="slide" data-id="'.$value['id'].'" data-status="'.$value['status'].'" class="'. $classStatus .' status__item">'. ucfirst($status) .'</span>
                                            </td> 
                                            <td>
                                                <ul class="list-inline table-action m-0">
                                                    
                                                    <li class="list-inline-item">
                                                        <a href="'. Url::createLink('admin', 'slide', 'form', ['task' => 'edit', 'id' => $value['id']]) .'" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <a href="javascript:void(0)" onclick="deleteItem('. $value['id'] .', \'slide\')" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>';
}
echo $xhtml;
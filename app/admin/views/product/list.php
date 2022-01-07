<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table id="scroll-horizontal-datatable" class="table w-100 nowrap table-striped table-data">
                    <thead>
                    <tr>
                        <th width="15" >No</th>
                        <th>Image</th>
                        <th>Product name</th>
                        <th class="d-none">Move</th>
                        <th>Rating</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $xhtml = '';
                    $num = 0;
                    if (!empty($this->data)){
                        foreach ($this->data as $key => $value){
                            $img = '';
                            if($value['image'] != null){
                                $img = '<img class="img__table img-fluid avatar-md rounded" src="'. $value['image'] .'">';
                            }
                            ++ $num;
                            $move = '';
                            if($key == 0){
                                $move .= '<i onclick="moveNode(\'down\', '.$value['id'].')" class="btnMove remixicon-arrow-down-circle-fill"></i>';
                                //continue;
                            }else if(count($this->data) - 1 == $key){
                                $move .= '<i onclick="moveNode(\'up\', '.$value['id'].')" class="btnMove-category remixicon-arrow-up-circle-fill"></i>';
                            }else {
                                $move .= '<i onclick="moveNode(\'up\', '.$value['id'].')" class="btnMove-category remixicon-arrow-up-circle-fill"></i>';
                                $move .= '<i onclick="moveNode(\'down\', '.$value['id'].')" class="btnMove-category remixicon-arrow-down-circle-fill"></i>';
                            }
                            //$category_name = $this->_model->getCategoryName($value['category_id']);
                            if ($num % 2 == 0){
                                $rating = '
                                <span class="badge bg-success"><i class="mdi mdi-star"></i> 4.9</span>
                            ';
                            }else{
                                $rating = '
                                <span class="badge bg-warning"><i class="mdi mdi-star"></i> 3.1</span>
                            ';
                            }
                            $status         = $value['status'] == 1 ? 'active' : 'deactive';
                            $classStatus    = $value['status'] == 1 ? 'activeStatus' : 'deactive';
                            $xhtml .= '<tr id="row-'. $value['id'] .'">
                                            <td>'. $num .'</td>
                                            <td>'. $img .'</td>
                                            <td>
                                            <a href="index.php?module=admin&controller=product&action=edit&task=edit&id='.$value['id'].'">
                                            '. $value['product_name'] .'</a>
                                            </td>
                                            <td class="d-none">'. $move .'</td>
                                            <td>'. $rating .'</td>
                                            <td>$'. $value['price'] .'</td>
                                            <td>'. $value['quantity'] .'</td>
                                            <td> <span data-control="product" data-id="'.$value['id'].'" data-status="'.$value['status'].'" class="'. $classStatus .' status__item">'. ucfirst($status) .'</span></td>
                                           
                                            <td>
                                                <ul class="list-inline table-action m-0">
                                                    <li class="list-inline-item">
                                                        <a target="_blank" href="'.$this->model->getLink($value['id']).'" class="action-icon"> <i class="fas fa-eye"></i></a>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <a href="index.php?module=admin&controller=product&action=edit&task=edit&id='.$value['id'].'" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <a href="javascript:void(0)" data-id="'. $value['id'] .'" data-table="products" data-control="product" onclick="delItem(this);" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>';
                        }
                    }


                    echo $xhtml;

                    ?>

                    </tbody>
                </table>
            </div>
        </div>

    </div>

</div>
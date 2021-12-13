<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table id="scroll-horizontal-datatable" class="table w-100 nowrap table-striped table-data">
                    <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Status</th>
<!--                        <th>Create at</th>-->
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody id="datatable">
                    <?php

                        $xhtml = '';
                        foreach ($this->data as $key => $value){
                            $img = '';
                            if($value['image'] != null){
                                $img = '<img class="img__table__slide" src="'. $value['image'] .'">';
                            }
                            $status         = $value['status'] == 1 ? 'active' : 'deactive';
                            $classStatus    = $value['status'] == 1 ? 'activeStatus' : 'deactive';
                            $xhtml .= '<tr id="row-'. $value['id'] .'">
                                                <td>'. $img .'</td>
                                                <td>'. $value['name'] .'</td>
                                                <td>'. $value['position'] .'</td>
                                                <td>
                                                    <span title="Change" data-control="banner" data-id="'.$value['id'].'" data-status="'.$value['status'].'" class="'. $classStatus .' status__item">'. ucfirst($status) .'</span>
                                                </td> 
                                                <td>
                                                    <ul class="list-inline table-action m-0">
                                                        
                                                        <li class="list-inline-item">
                                                            <a href="'. Url::createLink('admin', 'banner', 'form', ['task' => 'edit', 'id' => $value['id']]) .'" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <a href="javascript:void(0)" onclick="deleteItem('. $value['id'] .', \'banner\')" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>';
                        }
                        echo $xhtml;
                    ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</div>

<!--<li class="list-inline-item">-->
<!--    <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-eye"></i></a>-->
<!--</li>-->

<!--<td>'. $value['created_at'] .'</td>-->
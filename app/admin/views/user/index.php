<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table id="scroll-horizontal-datatable" class="table w-100 nowrap table-data">
                    <thead class="thead-light">
                    <tr>
                        <th>Avatar</th>
                        <th>First name</th>
                        <th>Last name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Status</th>
                        <th>Is admin</th>
<!--                        <th>Create at</th>-->
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        $xhtml = '';

                        foreach ($this->data as $key => $value){
                            $urlProfile = Url::createLink('admin', 'user', 'profile', ['id' => $value['id']]);
                            if($value['avatar'] == null){
                                $value['avatar'] = 'public/upload/users/avatar-1.jpg';
                            }
                            $status         = $value['status'] == 1 ? 'active' : 'deactive';
                            $admin          = $value['is_Admin'] == 1 ? 'active' : 'deactive';
                            $classStatus    = $value['status'] == 1 ? 'activeStatus' : 'deactive';
                            $classAdmin     = $value['is_Admin'] == 1 ? 'activeAdmin' : 'deactive';
                            $xhtml .= '<tr id="row-'. $value['id'] .'">
                                            <td><img class="img__table img-fluid avatar-md rounded" src="'. $value['avatar'] .'"></td>
                                            <td>'. $value['firstname'] .'</td>
                                            <td>'. $value['lastname'] .'</td>
                                            <td class="font-weight-bold">
                                                 <a href="'.$urlProfile.'">
                                                    '. $value['username'] .'
                                                  </a> 
                                            </td>
                                            <td>'. $value['email'] .'</td>
                                            <td>'. $value['phone'] .'</td>
                                            <td>'. $value['address'] .'</td>
                                            <td>
                                                <span data-control="user" data-id="'.$value['id'].'" data-status="'.$value['status'].'" class="'. $classStatus .' status__item">'. ucfirst($status) .'</span>
                                            </td>
                                            <td>
                                                <span data-control="user"  data-id="'.$value['id'].'" data-admin="'.$value['is_Admin'].'" class="'. $classAdmin .' is__admin__item">'.  ucfirst($admin) .'</span>
                                            </td>
                                           
                                            <td>
                                                <ul class="list-inline table-action m-0">
                                                    
                                                    <li class="list-inline-item">
                                                        <a href="'. Url::createLink('admin', 'user', 'form', ['task' => 'edit', 'id' => $value['id']]) .'" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <a href="javascript:void(0)" onclick="deleteItem('. $value['id'] .', \'user\')" class="action-icon"> <i class="mdi mdi-delete"></i></a>
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
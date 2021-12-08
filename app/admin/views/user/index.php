<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table id="scroll-horizontal-datatable" class="table w-100 nowrap table-striped table-data">
                    <thead>
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
                        <th>Create at</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        $xhtml = '';

                        foreach ($this->data as $key => $value){
                            $xhtml .= '<tr id="row-'. $value['id'] .'">
                                            <td><img width="40" height="60" src="public/upload/users/'. $value['avatar'] .'"></td>
                                            <td>'. $value['firstname'] .'</td>
                                            <td>'. $value['lastname'] .'</td>
                                            <td>'. $value['username'] .'</td>
                                            <td>'. $value['email'] .'</td>
                                            <td>'. $value['phone'] .'</td>
                                            <td>'. $value['address'] .'</td>
                                            <td>'. $value['status'] .'</td>
                                            <td>'. $value['is_Admin'] .'</td>
                                            <td>'. $value['created_at'] .'</td>
                                            <td>
                                                <ul class="list-inline table-action m-0">
                                                    <li class="list-inline-item">
                                                        <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-eye"></i></a>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <a href="javascript:void(0)" onclick="deleteItem('. $value['id'] .')" class="action-icon"> <i class="mdi mdi-delete"></i></a>
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
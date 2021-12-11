<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table id="scroll-horizontal-datatable" class="table w-100 nowrap table-striped table-data">
                    <thead>
                    <tr>
                        <th width="15" >No</th>
                        <th>Product name</th>
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
                    foreach ($this->data as $key => $value){
                        ++ $num;
                        $status     = $value['status'] == 1 ? 'active' : 'deactive';
                        $xhtml .= '<tr id="row-'. $value['id'] .'">
                                            <td>'. $num .'</td>
                                            <td>
                                            <a href="index.php?module=admin&controller=product&action=edit&task=edit&id='.$value['id'].'">
                                            '. $value['product_name'] .'</a>
                                            </td>
                                            <td>'. $value['price'] .'</td>
                                            <td>'. $value['quantity'] .'</td>
                                            <td> <span class="'. $status .'">'. ucfirst($status) .'</span></td>
                                           
                                            <td>
                                                <ul class="list-inline table-action m-0">
                                                    <li class="list-inline-item">
                                                        <a href="href="index.php?module=admin&controller=product&action=edit&task=edit&id='.$value['id'].'"" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <a href="javascript:void(0)" onclick="delItem('. $value['id'] .')" class="action-icon"> <i class="mdi mdi-delete"></i></a>
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
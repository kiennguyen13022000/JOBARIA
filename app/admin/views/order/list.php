<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row mb-1 d-none">
                    <div class="col-lg-4 ml-auto text-right">
                        <div class="text-lg-end">
                            <a href="index.php?module=admin&controller=order&action=edit" class="btn btn-danger mb-2 me-2"><i class="mdi mdi-basket me-1"></i> Add New Order</a>
                            <button type="button" class="btn btn-light mb-2">Export</button>
                        </div>
                    </div><!-- end col-->
                </div>
                <table id="scroll-horizontal-datatable" class="table w-100 nowrap table-striped table-data">
                    <thead>
                    <tr>
                        <th width="15" >No</th>
                        <th>Code</th>
                        <th>Billing Name</th>
                        <th>Date</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Payment Method</th>
                        <th class="d-none">Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $xhtml = '';
                    $num = 0;
                    foreach ($this->data as $key => $value){
                        ++ $num;
                        $payment_status = $value['status'];
                        //$category_name = $this->_model->getCategoryName($value['category_id']);
                        if ($payment_status == 2){
                            $payment_status_html = '
                                <div><span class="badge badge-soft-success">Paid</span>
                                                            </div>
                            ';
                        }elseif ($payment_status == 1){
                            $payment_status_html = '
                                <div><span class="badge bg-warning">Unpaid</span></div>
                            ';
                        }elseif ($payment_status == 4){
                            $payment_status_html = '
                            <div><span class="badge badge-soft-danger">Cancelled</span></div>
                        ';
                        }else{
                            $payment_status_html = '
                                <div><span class="badge badge-soft-warning">Awaiting Confirm</span></div>
                            ';
                        }
                        $status         = $value['status'] == 1 ? 'Shipped' : 'Delivered';
                        $classStatus    = $value['status'] == 1 ? 'activeStatus' : 'deactive';
                        $xhtml .= '<tr id="row-'. $value['id'] .'">
                                            <td>'. $num .'</td>
                                            <td>'. $value['code'] .'</td>
                                            <td>
                                            James Modlin	</a>
                                            </td>
                                            <td>'. $value['created_at'] .'</td>
                                            <td>$'. $value['total'] .'</td>
                                            <td>'.$payment_status_html.'</td>
                                            <td>Mastercard</td>
                                            <td class="d-none"> <span data-control="product" data-id="'.$value['id'].'" data-status="'.$value['status'].'" class="'. $classStatus .' status__item">'. ucfirst($status) .'</span></td>
                                           
                                            <td>
                                                <ul class="list-inline table-action m-0">
                                                    <li class="list-inline-item">
                                                        <a href="index.php?module=admin&controller=product&action=edit&task=edit&id='.$value['id'].'"" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <a href="javascript:void(0)" data-id="'. $value['id'] .'" data-table="products" data-control="product" onclick="delItem(this);" class="action-icon"> <i class="mdi mdi-delete"></i></a>
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
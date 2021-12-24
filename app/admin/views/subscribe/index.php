<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table id="scroll-horizontal-datatable" class="table w-100 nowrap table-striped table-data">
                    <thead>
                    <tr>
                        <th width="15" >No</th>
                        <th>Email</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $xhtml = '';
                    $num = 0;
                    foreach ($this->data as $key => $value){
                        ++ $num;

                        $xhtml .= '<tr id="row-'. $value['id'] .'">
                                            <td>'. $num .'</td>
                                            <td>'. $value['email'] .'</td>
                                            <td>'. $value['created_at'] .'</td>
                                            <td>
                                                <ul class="list-inline table-action m-0">
                                                    <li class="list-inline-item">
                                                        <a href="javascript:void(0)" data-id="'. $value['id'] .'" data-table="subscribe" data-control="subscribe" onclick="delItem(this);" class="action-icon"> <i class="mdi mdi-delete"></i></a>
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
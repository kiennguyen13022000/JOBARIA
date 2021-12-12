<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table id="scroll-horizontal-datatable" class="table w-100 nowrap table-striped table-data">
                    <thead>
                    <tr>
                        <th class="d-none">position</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Title 1</th>
                        <th>Title 2</th>
                        <th>Title 3</th>
                        <th>Title 4</th>
                        <th>Move</th>
                        <th>Status</th>
<!--                        <th>Create at</th>-->
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody id="datatable">
                    <?php
                        include_once APPLICATION_PATH . 'admin' . DS . 'views' . DS . 'slide' . DS . 'datatable.php'
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
<?php
?>
<div class="wrap mt30">

</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4>List email template </h4>
                <div class="row">
                    <?php
                        $list = '';
                        if (!empty($this->data)){
                            foreach ($this->data as $key => $value){
                                $list.= '
                                    <div class="col-lg-4 col-md-3 col-xs-12" >
                                    <div class="email_standard w-100">
                                        <a class="text-uppercase" href="index.php?module=admin&controller=setting&action=email_template&id='.$value['id'].'">
                                            <img align="top" src="public/template/admin/images/file-icons/massmail.png">
                                            '.$value['template_name'].'
                                        </a>
                                    </div>
                                </div>
                                ';
                            }
                        }
                        echo $list;
                    ?>

                </div>
            </div>
        </div>

    </div>

</div>
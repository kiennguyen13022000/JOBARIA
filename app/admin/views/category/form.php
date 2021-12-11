<?php

$valueUsername          = (isset($this->result['name'])) ? $this->result['name'] : '';
$valueParentId          = (isset($this->result['parent_id'])) ? $this->result['parent_id'] : '';
$valueAvatar            = (isset($this->result['image'])) ? $this->result['image'] : '';

$label = ['label' => 'Name', 'id' => 'validationName'];
$inputName = Helper::cmsFormGroup($label, 'text', 'name', $valueUsername, 'form-control', null, true, 'form-group mb-3', $this->errors);
$label = ['label' => 'Parent', 'id' => 'validationParentID'];
$arrDataParent = $this->categories;
$arrParent = Helper::cmsSelectBox($label, 'parent_id', 'custom-select', $arrDataParent, 'form-group mb-3', $valueParentId);
$label = ['label' => 'Image', 'id' => 'validationImage'];
$inputAvatar = Helper::cmsFormGroupFile($label, 'file', 'image', $valueAvatar, 'custom-file-input', null, false, 'form-group mb-3', $this->errors, 'category', $this->task);

// create radio
$valueStatus          = (isset($this->result['status'])) ? $this->result['status'] : '';

$raidoStatusActive = Helper::cmsRadio('status', 'Active', 1, $valueStatus);
$raidoStatusNotActive = Helper::cmsRadio('status','Not active',0, $valueStatus);
$link =Url::createLink('admin', 'category', 'form', ['task' => $this->task]);
if($this->task == 'edit'){
    $link =Url::createLink('admin', 'category', 'form', ['task' => $this->task, 'id' => $this->id]);
}
?>

<form method="post" enctype="multipart/form-data" class="w-100" action="<?php echo $link; ?>">
    <div class="row justify-content-center">
        <div class="col-xl-5 col-lg-7">
            <div class="card">
                <div class="card-body">
                    <?php echo $inputName . $arrParent . $inputAvatar; ?>
                    <button class="btn btn-primary" type="submit">Ok</button>
                </div>
            </div>

        </div>

        <div class="col-xl-4 col-lg-5">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <label for="validationCustom01">Status</label>
                                <div class="row">
                                    <div class="col-6">
                                        <?php echo $raidoStatusActive; ?>
                                    </div>
                                    <div class="col-6">
                                        <?php echo $raidoStatusNotActive; ?>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

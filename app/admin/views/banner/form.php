<?php

$valueUsername         = (isset($this->result['name'])) ? $this->result['name'] : '';
$valueTitle_1          = (isset($this->result['title_1'])) ? $this->result['title_1'] : '';
$valueTitle_2          = (isset($this->result['title_2'])) ? $this->result['title_2'] : '';
$valueTitle_3          = (isset($this->result['title_3'])) ? $this->result['title_3'] : '';
$valuePosition         = (isset($this->result['position'])) ? $this->result['position'] : '';
$valueUrl              = (isset($this->result['url'])) ? $this->result['url'] : '';
$valueAvatar           = (isset($this->result['image'])) ? $this->result['image'] : '';

$label = ['label' => 'Name', 'id' => 'validationName'];
$inputName = Helper::cmsFormGroup($label, 'text', 'name', $valueUsername, 'form-control',true, 'form-group mb-3', $this->errors);
$label = ['label' => 'Title_1', 'id' => 'validationTitle_1'];
$inputTitle_1 = Helper::cmsFormGroup($label, 'text', 'title_1', $valueTitle_1, 'form-control',false, 'form-group mb-3', $this->errors);
$label = ['label' => 'Title_2', 'id' => 'validationTitle_2'];
$inputTitle_2 = Helper::cmsFormGroup($label, 'text', 'title_2', $valueTitle_2, 'form-control',false, 'form-group mb-3', $this->errors);
$label = ['label' => 'Title_3', 'id' => 'validationTitle_3'];
$inputTitle_3 = Helper::cmsFormGroup($label, 'text', 'title_3', $valueTitle_3, 'form-control',false, 'form-group mb-3', $this->errors);
$label = ['label' => 'Position', 'id' => 'validationPosition'];
$inputPosition = Helper::cmsFormGroup($label, 'text', 'position', $valuePosition, 'form-control',true, 'form-group mb-3', $this->errors);
$label = ['label' => 'Url', 'id' => 'validationUrl'];
$inputUrl = Helper::cmsFormGroup($label, 'text', 'url', $valueUrl, 'form-control',  false, 'form-group mb-3', $this->errors);
$label = ['label' => 'Image', 'id' => 'validationImage', 'required' => true];
$inputAvatar = Helper::cmsFormGroupFile($label, 'file', 'image', $valueAvatar, 'custom-file-input', false, 'form-group mb-3', $this->errors, 'category', $this->task);

// create radio
$valueStatus          = (isset($this->result['status'])) ? $this->result['status'] : '';

$raidoStatusActive = Helper::cmsRadio('status', 'Active', 1, $valueStatus);
$raidoStatusNotActive = Helper::cmsRadio('status','Not active',0, $valueStatus);
$link =Url::createLink('admin', 'banner', 'form', ['task' => $this->task]);
if($this->task == 'edit'){
    $link =Url::createLink('admin', 'banner', 'form', ['task' => $this->task, 'id' => $this->id]);
}
?>

<form method="post" enctype="multipart/form-data" class="w-100" action="<?php echo $link; ?>">
    <div class="row justify-content-center">
        <div class="col-xl-8 col-lg-7">
            <div class="card">
                <div class="card-body">
                    <?php echo $inputName . $inputTitle_1 . $inputTitle_2 . $inputTitle_3 . $inputPosition . $inputUrl; ?>
                </div>
            </div>

        </div>

        <div class="col-xl-4 col-lg-5">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <h4 class="font-weight-bold text-primary mt-0 border-bottom px-3 py-2">Action</h4>
                        <div class="card-body py-2">
                            <div class="form-group">
                                <button type="submit" name="submit" value="save" class="submitForm btn btn-warning waves-effect waves-light">
                                    <i class="bx bx-save"></i> Save
                                </button>
                                <?php
                                    if ($this->task == 'add')
                                        echo '<button type="submit" name="submit" value="save-edit" class="submitForm ml-2 btn btn-danger waves-effect waves-light">
                                               <i class="bx bx-edit"></i> Save & Edit
                                            </button>';
                                ?>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <h4 class="font-weight-bold text-primary mt-0 border-bottom px-3 py-2">Status</h4>
                        <div class="card-body py-2">
                            <div class="form-group mb-3">
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
                <div class="col-12">
                    <div class="card">
                        <h4 class="font-weight-bold text-primary mt-0 border-bottom px-3 py-2">Image</h4>
                        <div class="card-body py-2">
                            <?php echo $inputAvatar; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

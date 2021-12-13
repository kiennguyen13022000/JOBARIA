<?php

$valueUsername         = (isset($this->result['name'])) ? $this->result['name'] : '';
$valuePosition         = (isset($this->result['position'])) ? $this->result['position'] : '';
$valueUrl              = (isset($this->result['url'])) ? $this->result['url'] : '';
$valueAvatar           = (isset($this->result['image'])) ? $this->result['image'] : '';

$label = ['label' => 'Name', 'id' => 'validationName'];
$inputName = Helper::cmsFormGroup($label, 'text', 'name', $valueUsername, 'form-control',true, 'form-group mb-3', $this->errors);
$label = ['label' => 'Position', 'id' => 'validationPosition'];
$inputPosition = Helper::cmsFormGroup($label, 'text', 'position', $valuePosition, 'form-control',true, 'form-group mb-3', $this->errors);
$label = ['label' => 'Url', 'id' => 'validationUrl'];
$inputUrl = Helper::cmsFormGroup($label, 'text', 'url', $valueUrl, 'form-control',  true, 'form-group mb-3', $this->errors);
$label = ['label' => 'Image', 'id' => 'validationImage'];
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
        <div class="col-xl-5 col-lg-7">
            <div class="card">
                <div class="card-body">
                    <?php echo $inputName . $inputPosition . $inputUrl . $inputAvatar; ?>
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

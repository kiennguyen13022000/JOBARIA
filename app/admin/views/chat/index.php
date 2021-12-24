<?php
$avatar = empty($this->userInfo['avatar']) ? '/public/template/admin/images/users/avatar-1.jpg' : $this->userInfo['avatar'];
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-3 col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="inbox-user">
                            <img src="<?php echo $avatar; ?>" class="rounded-circle">
                        </div>
                        <div class="pl-2 flex-grow-1 position-relative">
                            <h5 class="mt-0 mb-1"><?php echo $this->userInfo['firstname']. ' ' . $this->userInfo['lastname']; ?></h5>
                            <span>
                                 <small class="mdi mdi-circle text-success"></small>
                                Online
                            </span>
                            <div class="position-absolute inbox-settings">
                                <i class="remixicon-settings-5-line"></i>
                            </div>
                        </div>
                    </div>

                    <div class="inbox-search-user position-relative my-3">
                        <input type="text" class="input-inbox-search-user form-control rounded-pill" placeholder="People">
                        <i class="remixicon-search-line inbox-icon-search"></i>
                        <div class="user-search">
                        </div>
                    </div>

                    <div class="inbox-widget slimscroll" style="max-height: 394px;">
                        <?php require_once 'user-inbox.php'; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-9 col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="chat-conversation">
                        <ul class="conversation-list slimscroll" style="max-height: 340px;">
                            <?php require_once 'inbox-detail.php'; ?>

                        </ul>
                        <div class=" ">
                            <div class="d-flex wrapper-input-inbox-send">
                                <textarea id="emoji" class="form-control chat-input flex-grow-1" rows="3" placeholder="Enter your text"></textarea>
                                <button type="submit" class="align-self-center btn btn-primary chat-send-my ml-3 waves-effect waves-light">
                                    <i class="remixicon-send-plane-fill"></i>
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

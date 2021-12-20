<?php
    $fullname = $this->info['firstname'] . ' ' . $this->info['lastname'];
    if($this->info['avatar'] == null){
        $this->info['avatar'] = 'public/upload/users/avatar-1.jpg';
    }
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-4 col-xl-4">
            <div class="card-box text-center">
                <img src="<?php echo $this->info['avatar'];?>" class="rounded-circle avatar-xl img-thumbnail" alt="profile-image">

                <h4 class="mb-0"><?php echo $fullname;?></h4>

                <div class="text-left mt-3">

                    <p class="text-muted mb-2 font-13"><strong>Full Name :</strong> <span class="ml-2"><?php echo $fullname;?></span></p>

                    <p class="text-muted mb-2 font-13"><strong>Mobile :</strong><span class="ml-2"><?php echo $this->info['phone'];?></span></p>

                    <p class="text-muted mb-2 font-13"><strong>Email :</strong> <span class="ml-2 "><?php echo $this->info['email'];?></span></p>

                    <p class="text-muted font-13 mb-3">
                        <strong>Address :</strong>
                        <?php echo $this->info['address'];?>
                    </p>

                </div>
            </div>
        </div>
        <div class="col-lg-8 col-xl-8">
            <div class="card-box">
                <ul class="nav nav-pills navtab-bg">
                    <li class="nav-item">
                        <a href="#about-me" data-toggle="tab" aria-expanded="true" class="nav-link ml-0">
                            <i class="mdi mdi-face-profile mr-1"></i>About Me
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#settings" data-toggle="tab" aria-expanded="false" class="nav-link active">
                            <i class="mdi mdi-settings-outline mr-1"></i>Settings
                        </a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active" id="settings">
                        <form>
                            <h5 class="mb-3 text-uppercase bg-light p-2"><i class="mdi mdi-account-circle mr-1"></i> Đổi mật khẩu</h5>
                            <div class="form-group">
                                <label for="firstname">Mật Khẩu cũ</label>
                                <input type="text" class="form-control" id="firstname" placeholder="Enter first name">
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="firstname">Mật Khẩu mới</label>
                                        <input type="text" class="form-control" id="firstname" placeholder="Enter first name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="lastname">Mật lại mật khẩu</label>
                                        <input type="text" class="form-control" id="lastname" placeholder="Enter last name">
                                    </div>
                                </div> <!-- end col -->
                            </div> <!-- end row -->


                            <div class="text-right">
                                <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i class="mdi mdi-content-save"></i> Save</button>
                            </div>
                        </form>
                    </div>
                    <!-- end settings content-->

                </div> <!-- end tab-content -->
            </div> <!-- end card-box-->

        </div>
    </div>
</div>
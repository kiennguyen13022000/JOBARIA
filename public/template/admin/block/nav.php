<div class="left-side-menu">
    <div class="slimscroll-menu">
        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul class="metismenu" id="side-menu">
                <li <?php if($this->control == 'index' && $this->action == 'index')  echo 'class="mm-active"' ?>>
                    <a href="index.php?module=admin&controller=index&action=index"
                       class="waves-effect">
                        <i class="remixicon-dashboard-line"></i>
                        <span> Dashboards </span>
                    </a>

                </li>
                <li <?php if($this->control == 'category')  echo 'class="mm-active"' ?>>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class="remixicon-list-check"></i>
                        <span> Category </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li>
                            <a <?php if($this->control == 'category' && $this->action == 'form' && $this->task == 'add')  echo 'class="active"' ?>
                                    href="index.php?module=admin&controller=category&action=form">
                                Add Category</a>
                        </li>
                        <li>
                            <a <?php if($this->control == 'category' && $this->action == 'index')  echo 'class="active"' ?>
                                    href="index.php?module=admin&controller=category&action=index">List Category</a>
                        </li>

                    </ul>
                </li>
                <li <?php if($this->control == 'chat')  echo 'class="mm-active"' ?>>
                    <a href="index.php?module=admin&controller=chat&action=index" class="waves-effect">
                        <i class="remixicon-message-2-line"></i>
                        <span> Chat </span>
                    </a>
                </li>

                <li <?php if($this->control == 'product')  echo 'class="mm-active"' ?>>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class="remixicon-product-hunt-line"></i>
                        <span> Product </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li>
                            <a  <?php if($this->control == 'product' && $this->action == 'edit' && $this->task == 'add')  echo 'class="active"' ?>
                                    href="index.php?module=admin&controller=product&action=edit">Add Product</a>
                        </li>
                        <li>
                            <a <?php if($this->control == 'product' && $this->action == 'list')  echo 'class="active"' ?>
                                    href="index.php?module=admin&controller=product&action=list">List Product</a>
                        </li>

                    </ul>
                </li>

                <li <?php if($this->control == 'order')  echo 'class="mm-active"' ?>>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class="fas fa-dollar-sign"></i>
                        <span> Order </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li>
                            <a <?php if($this->control == 'order' && $this->action == 'list')  echo 'class="active"' ?>
                                    href="index.php?module=admin&controller=order&action=list">List Orders</a>
                        </li>

                    </ul>
                </li>
                <li <?php if($this->control == 'slide')  echo 'class="mm-active"' ?>>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class="remixicon-slideshow-3-line"></i>
                        <span> Slider </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li>
                            <a <?php if($this->control == 'slide' && $this->action == 'form' && $this->task == 'add')  echo 'class="active"' ?>
                                    href="index.php?module=admin&controller=slide&action=form">Add Slider</a>
                        </li>
                        <li>
                            <a <?php if($this->control == 'slide' && $this->action == 'index')  echo 'class="active"' ?>
                                    href="index.php?module=admin&controller=slide&action=index">List Slider</a>
                        </li>
                    </ul>
                </li>
                <li <?php if($this->control == 'banner')  echo 'class="mm-active"' ?>>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class="remixicon-bank-card-line"></i>
                        <span> Banner </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li>
                            <a <?php if($this->control == 'banner' && $this->action == 'form' && $this->task == 'add')  echo 'class="active"' ?>
                                    href="index.php?module=admin&controller=banner&action=form">Add Banner</a>
                        </li>
                        <li>
                            <a <?php if($this->control == 'banner' && $this->action == 'index')  echo 'class="active"' ?>
                                    href="index.php?module=admin&controller=banner&action=index">List Banner</a>
                        </li>
                    </ul>
                </li>
                <li <?php if($this->control == 'user')  echo 'class="mm-active"' ?>>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class="remixicon-user-follow-line"></i>
                        <span> User </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li>
                            <a <?php if($this->control == 'user' && $this->action == 'form' && $this->task == 'add')  echo 'class="active"' ?>
                                    href="index.php?module=admin&controller=user&action=form">Add user</a>
                        </li>
                        <li>
                            <a <?php if($this->control == 'user' && $this->action == 'index')  echo 'class="active"' ?>
                                    href="index.php?module=admin&controller=user&action=index">List User</a>
                        </li>

                    </ul>
                </li>
                <li <?php if($this->control == 'subscribe')  echo 'class="mm-active"' ?>>
                    <a href="index.php?module=admin&controller=subscribe&action=index" class="waves-effect">
                        <i class="fas fa-envelope-square"></i>
                        <span>Subcribe</span>
                    </a>
                </li>
                <li <?php if($this->control == 'setting')  echo 'class="mm-active"' ?>>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class="remixicon-user-follow-line"></i>
                        <span>Setting </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li>
                            <a <?php if($this->control == 'setting' && $this->action == 'index' )  echo 'class="active"' ?>
                                    href="index.php?module=admin&controller=setting&action=index">General</a>
                        </li>
                        <li>
                            <a <?php if($this->control == 'user' && $this->action == 'email_template')  echo 'class="active"' ?>
                                    href="index.php?module=admin&controller=setting&action=listTemplate">Setting Email</a>
                        </li>

                    </ul>
                </li>
            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
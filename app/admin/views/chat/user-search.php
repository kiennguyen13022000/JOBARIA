<?php
$htmlUser = '';

foreach ($this->userSearch as $key => $value){
    $avatar = empty($value['avatar']) ? '/public/template/admin/images/users/avatar-1.jpg' : $value['avatar'];
    $htmlUser .= '<div class="user-search-item d-flex my-2" data-id="'.$value['id'].'">
                    <div class="inbox-user">
                        <img src="'. $avatar. '" class="rounded-circle">
                    </div>
                    <div class="pl-2">
                        <p class="title-author">'. $value['firstname'] . ' ' . $value['lastname'] . '</>
                    </div>
                </div>';
}
?>

<div class="wrapper-user-search shadow-lg">
    <div class="triangle"></div>
    <?php echo $htmlUser; ?>
</div>
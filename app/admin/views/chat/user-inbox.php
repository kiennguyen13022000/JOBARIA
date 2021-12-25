<?php

$html = '';
foreach ($this->userInbox as $key => $value){
    $avatar = empty($value['avatar']) ? '/public/template/admin/images/users/avatar-1.jpg' : $value['avatar'];
    $userInboxActive = $key == 0 ? 'user-inbox-active' : '';
    $html .= '<div class="inbox-item '. $userInboxActive .'" data-user_id="'. $value['user_id'] .'">
               <a href="javascript:void(0)">
                  <div class="inbox-item-img"><img src="'. $avatar .'" class="rounded-circle" alt=""></div>
                    <p class="inbox-item-author">'. $value['fullname'] .'</p>
                    <p class="inbox-item-text">'. $value['content'] .'</p>
               </a>
            </div>';
}

echo $html;
//<p class="inbox-item-date">'. $value['created_at'] .'</p>
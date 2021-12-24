<?php

$html = '';
foreach ($this->userInbox as $key => $value){
    $avatar = empty($value['avatar']) ? '/public/template/admin/images/users/avatar-1.jpg' : $value['avatar'];
    $html .= '<div class="inbox-item">
               <a href="#">
                  <div class="inbox-item-img"><img src="'. $avatar .'" class="rounded-circle" alt=""></div>
                    <p class="inbox-item-author">'. $value['fullname'] .'</p>
                    <p class="inbox-item-text">'. $value['content'] .'</p>
                     
               </a>
            </div>';
}

echo $html;
//<p class="inbox-item-date">'. $value['created_at'] .'</p>
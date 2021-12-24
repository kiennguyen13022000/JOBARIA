<?php

$html = '';
foreach ($this->inboxDetail as $key => $value){
    $alternate = $this->userInfo['id'] == $value['user_id'] ? '' : 'odd';
    $avatar = empty($value['image']) ? '/public/template/admin/images/users/avatar-1.jpg' : $value['image'];
     $html .= '<li class="clearfix '. $alternate .'">
                    <div class="chat-avatar">
                        <img src="'. $avatar .'" alt="Female">
                        <i>10:01</i>
                    </div>
                    <div class="conversation-text">
                        <div class="ctext-wrap">
                            <i>'. $value['fullname'] .'</i>
                            <p>
                                '. $value['content'] .'
                            </p>
                        </div>
                    </div>
               </li>';
}

echo $html;


<?php

class ChatController extends Controller
{
    public function indexAction(){
        $this->_view->title = 'Chat';
        $this->createLinkCss();
        $this->createLinkJs();
        $this->_view->control = $this->_arrParam['controller'];
        $userInfo =  Session::get('userAdmin')['userInfo'];
        $this->_view->userInfo = $userInfo;
        $this->_view->userInbox = $this->_model->getUserInbox($userInfo['id']);

        $this->_view->inboxDetail = [];
        if (!empty($this->_view->userInbox)){
            $ids = [];
            foreach ($this->_view->userInbox as $value){
                $ids[] = $value['user_id'];
            }
            $ids = implode(',', $ids);
            $userChat = $this->_view->userInbox[0];
            Session::set('userChat', $userChat['user_id']);
            $this->_view->inboxDetail = $this->_model->getInboxDetail($userInfo['id'], $userChat['user_id']);
            $userInbox = $this->_model->getUserInboxEmpty($userInfo['id'], $ids);

            $this->_view->userInbox = array_merge($this->_view->userInbox, $userInbox);

        }else{
            $this->_view->userInbox = $this->_model->getUserInboxEmpty($userInfo['id']);
            $userInbox_0 = !empty($this->_view->userInbox[0]) ? $this->_view->userInbox[0] : array();
            if (!empty($userInbox_0)){
                $userChat = $userInbox_0;
                Session::set('userChat', $userChat['user_id']);
                $this->_view->inboxDetail = $this->_model->getInboxDetail($userInfo['id'], $userChat['user_chat']);
            }

        }
        $this->_view->action = $this->_arrParam['action'];
        $this->_view->render('chat/index');
    }

    public function userSearchAction(){
        $keyword = $this->_arrParam['keyword'];
        $result = $this->_model->userSearch($keyword);
        if (!empty($result) && !empty($keyword)){
            $this->_view->userSearch = $result;
            $this->_view->render('chat/user-search', false);
        }
    }
    public function infoChatItemAction(){
        $id = $this->_arrParam['id'];
        Session::set('userChat', $id);
        $result = $this->_model->infoChatItem($id);
        echo json_encode($result);
    }

    public function inboxDetailAction(){
        $userInfo =  Session::get('userAdmin')['userInfo'];
        $this->_view->userInfo = $userInfo;
        $user_id = $this->_arrParam['user_id'];
        Session::set('userChat', $user_id);
        $this->_view->inboxDetail = $this->_model->getInboxDetail($userInfo['id'], $user_id);
        $this->_view->render('chat/inbox-detail', false);
    }

    public function messageAction(){
        $pusher = Pusher::inti();
        $userInfo =  Session::get('userAdmin')['userInfo'];
        $userChat =  Session::get('userChat');

        $chatModel = $this->_model->message($this->_arrParam['message'], $userInfo, $userChat);
        $chatModel['created_at'] = DateFormat::createDateFormat($chatModel['created_at']);
        $pusher->trigger('private-message-'. $userChat .'-channel', 'message-event', $chatModel);
        echo json_encode(['message' => $chatModel]);
    }

    public function authAction(){
        $pusher = Pusher::inti();
        if (!empty(Session::get('userAdmin'))){
            echo $pusher->socket_auth($_POST['channel_name'], $_POST['socket_id']);
        }
    }
    private function createLinkCss(){
        $css = array(


            array(
                'link' => '/public/template/admin/images\custom\favicon.ico',
                'type' => '',
                'rel'  => 'shortcut icon'
            ),
            array(
                'link' => '/public/template/admin\libs\sweetalert2\sweetalert2.min.css',
                'type' => '',
                'rel'  => 'stylesheet'
            ),
             array(
                 'link' => '/node_modules/emojionearea/dist/emojionearea.min.css',
                 'type' => '',
                 'rel'  => 'stylesheet'
             ),
            array(
                'link' => '/public/template/admin/css/bootstrap.min.css',
                'type' => 'text/css',
                'rel'  => 'stylesheet'
            ),
            array(
                'link' => '/public/template/admin/css/icons.min.css',
                'type' => 'text/css',
                'rel'  => 'stylesheet'
            ),
            array(
                'link' => '/public/template/admin/css/app.min.css',
                'type' => 'text/css',
                'rel'  => 'stylesheet'
            ),
            array(
                'link' => '/public/template/admin/css/chat.css',
                'type' => 'text/css',
                'rel'  => 'stylesheet'
            )
        );

        $link = '';

        foreach ($css as $key => $value){
            $link .= '<link href="'. $value['link'] .'" rel="'. $value['rel'] .'" type="'. $value['type'] .'">';
        }

        $this->_view->linkCss = $link;
    }
    private function createLinkJs(){

        $css = array(
            array(
                'link' => '/public/template/admin/js\vendor.min.js',
            ),
            array(
                'link' => '/public/template/admin/libs/moment\moment.min.js',
            ),
            array(
                'link' => '/public/template/admin/libs\jquery-scrollto\jquery.scrollTo.min.js',
            ),
            array(
                'link' => '/public/template/admin/libs\sweetalert2\sweetalert2.min.js',
            ),
            array(
                'link' => '/public/template/admin/libs\jquery-sparkline\jquery.sparkline.min.js',
            ),
            array(
                'link' => '/public/template/admin/libs\jquery-knob\jquery.knob.min.js',
            ),
            array(
                'link' => '/public/template/admin/js\pages\jquery.chat.js',
            ),
            array(
                'link' => '/public/template/admin/js\pages\jquery.todo.js',
            ),
            array(
                'link' => '/public/template/admin/js\pages\widgets.init.js',
            ),
            array(
                'link' => '/public/template/admin/js\app.min.js',
            ),
            array(
                'link' => '/node_modules/emojionearea/dist/emojionearea.min.js',
            ),
            array(
                'link' => 'https://js.pusher.com/7.0/pusher.min.js',
            ),
            array(
                'link' => '/public/template/admin/js\chat.js',
            )
        );

        $link = '';
        foreach ($css as $key => $value){
            $link .= '<script src="'. $value['link'] .'"></script>';
        }

        $this->_view->linkJs = $link;
    }
}
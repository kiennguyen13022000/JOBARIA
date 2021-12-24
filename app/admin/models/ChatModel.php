<?php

class ChatModel extends Model
{
    public function userSearch($keyword){
        $user_id = Session::get('userAdmin')['user_id'];
        $query = [];
        $query[] = "select `id`, `firstname`, `lastname`, `avatar` from `users`";
        $query[] = "where id <> $user_id and (`username` like '%$keyword%'";
        $query[] = "or `firstname` like '%$keyword%'";
        $query[] = "or `lastname` like '%$keyword%')";
        $query = implode(' ', $query);
        return $this->ListRecord($query);
    }
    public function infoChatItem($id){
        $user_id = Session::get('userAdmin')['user_id'];
        $query = [];
        $query[] = "select `id`, `firstname`, `lastname`, `avatar` from `users`";
        $query[] = "where id = $id";
        $query = implode(' ', $query);
        $infoChatItem = $this->OneRecord($query);
        $chatDetail = $this->getInboxDetail($user_id, $id);
        return ['infoChatItem' => $infoChatItem, 'chatDetail' => $chatDetail];
    }

    public function getUserInbox($user_id){
         $query  = "SELECT MAX(user_chat) as id FROM chats WHERE user_chat <> $user_id GROUP by user_chat ORDER BY id";
        $idUserInbox   = $this->ListRecord($query);
        $result = [];
        foreach ($idUserInbox as $key => $value){
            $query = [];
            $query[] = 'SELECT c.content, c.user_id, c.user_chat, u.avatar, CONCAT(u.firstname, " ", u.lastname) as fullname';
            $query[] = "FROM users as u, chats as c";
            $query[] = "WHERE u.id = $value[id] and c.user_id = $value[id]";
            $query[] = "ORDER BY c.id DESC LIMIT 1";
            $query = implode(' ', $query);
            $inboxItem = $this->OneRecord($query);
            if (empty($inboxItem)){
                $query = [];
                $query[] = 'SELECT c.content, c.user_id, c.user_chat, u.avatar, CONCAT(u.firstname, " ", u.lastname) as fullname';
                $query[] = "FROM users as u, chats as c";
                $query[] = "WHERE u.id = $value[id] and c.user_id = $user_id";
                $query[] = "and c.user_chat = $value[id]";
                $query[] = "ORDER BY c.id DESC LIMIT 1";
                 $query = implode(' ', $query);
                $inboxItem = $this->OneRecord($query);
                $result[] = $inboxItem;
            }else{
                $result[] = $inboxItem;
            }
        }
        return $result;
    }

    public function getInboxDetail($user_id, $user_chat){
        $query = [];
        $query[] = "select * from `chats`";
        $query[] = "where user_id = $user_chat and user_chat = $user_id";
        $query[] = "or (user_id = $user_id and user_chat = $user_chat)";
        $query[] = "or user_chat = $user_chat";
        $query = implode(' ', $query);
        return $this->ListRecord($query);
    }

    public function message($message, $userInfo, $userChat){
        $this->SetTable('chats');
        $arrParam = [];
        $arrParam['user_id']    = $userInfo['id'];
        $arrParam['user_chat']  = $userChat['user_id'];
        $arrParam['fullname']   = $userInfo['firstname'] . ' ' . $userInfo['lastname'];
        $arrParam['image']      = $userInfo['avatar'];
        $arrParam['content']    = mysqli_real_escape_string($this->connect, $message);
        $arrParam['created_at'] = date('Y-m-d: H:i:s');
        $this->Insert($arrParam);
        $lastId = $this->LastId();
        $query = "select * from `chats` where id = $lastId";
        return $this->OneRecord($query);
    }
}
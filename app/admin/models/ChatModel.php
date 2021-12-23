<?php

class ChatModel extends Model
{
    public function userSearch($keyword){
        $query = [];
        $query[] = "select `id`, `firstname`, `lastname`, `avatar` from `users` where";
        $query[] = "`username` like '%$keyword%'";
        $query[] = "or `firstname` like '%$keyword%'";
        $query[] = "or `lastname` like '%$keyword%'";
         $query = implode(' ', $query);
        return $this->ListRecord($query);
    }
    public function infoChatItem($id){
        $query = [];
        $query[] = "select `id`, `firstname`, `lastname`, `avatar` from `users`";
        $query[] = "where id = $id";
//        $query = [];
//        $query[] = "select c.*, u.`id`, `firstname`, `lastname`, `avatar` from `users` as u left join `chats` as c";
//        $query[] = 'on u.id = c.user_id';
//        $query[] = "where u.id = $id";
         $query = implode(' ', $query);
        return $this->OneRecord($query);
    }

    public function getUserInbox($user_id){
        $query = [];
        $query[] = "select * from `chats` where user_chat = $user_id group by id order by id desc";
         $query = implode(' ', $query);
        return $this->ListRecord($query);
    }

    public function getInboxDetail($user_id, $user_chat){
        $query = [];
        $query[] = "select * from `chats`";
        $query[] = "where user_id = $user_id or user_id = $user_chat[user_id] and user_chat = $user_id";
        $query = implode(' ', $query);
        return $this->ListRecord($query);
    }


}
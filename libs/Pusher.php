<?php

class Pusher
{
    public static function inti(){
        $options = array(
            'cluster' => 'ap1',
            'useTLS' => true
        );
        $pusher = new Pusher\Pusher(
            'f0da0738e29f80193f63',
            '745121e123abda424d12',
            '1320404',
            $options
        );

        return $pusher;
    }
}
<?php

class FlashMessage
{
    const ERROR = 0;
    const SUCCESS = 1;

    public static function add_Msg($message = null, $type)
    {
        // if(isset($_SESSION['flash_message'])) {
        //     $_SESSION['flash_message'] = [
        //         'message' => $message,
        //         'type' => $type
        //     ];
        // } else {

            $_SESSION['flash_message'] = [];
            $_SESSION['flash_message']= [
                'message' => $message,
                'type' => $type
            ];
        // }
    }

    public static function show_Msg()
    {
        $message = '';
        if(isset($_SESSION['flash_message'])){
            if($_SESSION['flash_message']['type'] === self::SUCCESS){
                $message = '<div class="uk-alert uk-alert-success">'. $_SESSION['flash_message']['message'].'</div>';
            } elseif ($_SESSION['flash_message']['type'] === self::ERROR) {
                $message = '<div class="uk-alert uk-alert-danger">'. $_SESSION['flash_message']['message'].'</div>';
            }
            self::clear_session();
        }
        return $message;
    }

    public static function clear_session()
    {
        unset($_SESSION['flash_message']);
    }
}
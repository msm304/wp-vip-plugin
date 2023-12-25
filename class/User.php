<?php

class User
{
    public static function is_user_vip($user_id)
    {
        if (metadata_exists('user', $user_id, '_vip')) {
            $user_vip_data = get_user_meta($user_id, '_vip', true);
            if ($user_vip_data['expired_date'] >= date('Y-m-d')) {
                return true;
            } else {
                $user_vip_status = ['status' => '0'];
                $new_user_vip_data = array_replace($user_vip_data, $user_vip_status);
                update_user_meta($user_id, '_vip', $new_user_vip_data);
                // update_user_meta($user_id, '_vip_status', '0');
                // return false;
            }
        }
    }

    public static function add_vip_user($plan_type, $user_id)
    {
        $get_vip_info = get_user_meta($user_id, '_vip', true);
        if (self::is_user_vip($user_id)) {
            switch ($plan_type) {
                case 1:
                    $expired_date = date('Y-m-d', strtotime($get_vip_info['expired_date'] . '+3 months'));
                    break;
                case 2:
                    $expired_date = date('Y-m-d', strtotime($get_vip_info['expired_date'] . '+2 months'));
                    break;
                case 3:
                    $expired_date = date('Y-m-d', strtotime($get_vip_info['expired_date'] . '+1 months'));
                    break;
            }
        } else {
            switch ($plan_type) {
                case 1:
                    $expired_date = date('Y-m-d', strtotime('+3 months'));
                    break;
                case 2:
                    $expired_date = date('Y-m-d', strtotime('+2 months'));
                    break;
                case 3:
                    $expired_date = date('Y-m-d', strtotime('+1 months'));
                    break;
            }
        }
        update_user_meta($user_id, '_vip', [
            'account_type' => $plan_type,
            'status' => 1,
            'start_date' => date('Y-m-d'),
            'expired_date' => $expired_date
        ]);
        // update_user_meta($user_id, '_vip_status','1');
    }

    public static function get_vip_users()
    {
        $args = [
            'fields' => ['id', 'display_name', 'user_email'],
            'meta_key' => '_vip',
            'orderby' => 'ID',
            'order' => 'DESC'
        ];
        $users = new WP_User_Query($args);
        return $users->get_results();
    }
}

<?php

if (User::is_user_vip(get_current_user_id())) {
    add_filter('get_avatar', 'wp_vip_avatar', 1, 5);
    function wp_vip_avatar($avatar, $email, $size, $default, $alt)
    {
        $vip_user_email = wp_get_current_user()->user_email;
        $vip_user_name = wp_get_current_user()->display_name;
        $vip_user_avatar_url = get_avatar_url($vip_user_email);

        return $vip_user_avatar = "<span class='user-vip-badge'>VIP</span><img alt='{$vip_user_name}' src='{$vip_user_avatar_url}' class='avatar photo avatar-{$size} circle' height='{$size}' width='{$size}'>";
    }
}

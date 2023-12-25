<?php

function filter_vip_content($content)
{
    if (metadata_exists('post', get_the_ID(), '_vip_post_type') && get_post_meta(get_the_ID(), '_vip_post_type', true) == 2) {
        if (User::is_user_vip(get_current_user_id())) {
            return $content;
        } else {
            return mb_substr($content, 0, 500, 'UTF-8') . '...' . '<div class="vip-alert">برای مشاهده ادامه این مطلب باید اکانت ویژه (VIP) تهیه نمایید.</div>';
        }
    }
    return $content;
}
add_filter('the_content', 'filter_vip_content');

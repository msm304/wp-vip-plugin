<?php

function wp_register_vip_widget()
{
    wp_add_dashboard_widget(
        'vip_widget',
        'اطلاعات اکانت اشتراک ویژه شما',
        'wp_vip_widget_content_render'
    );
}

function wp_vip_widget_content_render()
{
    if (User::is_user_vip(get_current_user_id())) {
        $vip_data = get_user_meta(get_current_user_id(), '_vip', true);
?>
        <div class="uk-container-expand">
            <div class="user-vip-wrapper uk-margin-small uk-flex uk-flex-between">
                <span>نوع اکانت</span>
                <span><?php echo Helper::accountType($vip_data['account_type']) ?></span>
            </div>
            <div class="user-vip-wrapper uk-margin-small uk-flex uk-flex-between">
                <span>تاریخ شروع</span>
                <span><?php echo Helper::toJalali($vip_data['start_date'], '/') ?></span>
            </div>
            <div class="user-vip-wrapper uk-margin-small uk-flex uk-flex-between">
                <span>تاریخ اتمام</span>
                <span><?php echo Helper::toJalali($vip_data['expired_date'], '/') ?></span>
            </div>
            <div class="user-vip-wrapper uk-margin-small uk-flex uk-flex-between">
                <span>زمان باقیمانده</span>
                <span><?php echo Helper::calculateRemainingVipCredit($vip_data['expired_date']) ?></span>
            </div>
            <div class="user-vip-wrapper uk-margin-small uk-flex uk-flex-between">
                <span>وضعیت</span>
                <span><?php echo Helper::vipStatus($vip_data['status']) ?></span>
            </div>
        </div>
<?php
    } else {
        echo '<div>شما عضو ویژه سایت نمی باشید.</div>';
    }
}

add_action('wp_dashboard_setup', 'wp_register_vip_widget');

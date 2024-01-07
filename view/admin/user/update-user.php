<?php

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if (isset($_GET['action']) && $_GET['action'] == 'update' && isset($_GET['id'])) {
        $user_id = intval($_GET['id']);
        $vip_user_data = get_user_meta($user_id, '_vip', true);
        $current_user_data = get_userdata($user_id);
?>
        <div class="uk-container uk-container-expand">
            <h1 class="uk-margin-top">ویرایش کاربر</h1>
            <form method="post" action="" class="uk-grid-small" uk-grid>

                <div class="uk-width-1-4@s">
                    <input class="uk-input" type="text" value="<?php echo $current_user_data->display_name ?>" placeholder="نام و نام خانوادگی" disabled>
                </div>

                <div class="uk-width-1-4@s">
                    <input class="uk-input" type="text" value="<?php echo $current_user_data->user_email ?>" placeholder="ایمیل" disabled>
                </div>

                <div class="uk-width-1-4@s">
                    <select class="uk-select" name="account_type" aria-label="Select">
                        <option value="1" <?php selected($vip_user_data['account_type'], 1) ?>>طلایی</option>
                        <option value="2" <?php selected($vip_user_data['account_type'], 2) ?>>نقره ای</option>
                        <option value="3" <?php selected($vip_user_data['account_type'], 3) ?>>برنزی</option>
                    </select>
                </div>

                <div class="uk-width-1-4@s">
                    <input class="uk-input" name="start_date" type="text" value="<?php echo Helper::toJalali($vip_user_data['start_date'], '-') ?>" placeholder="تاریخ شروع" data-jdp>
                </div>

                <div class="uk-width-1-4@s">
                    <input class="uk-input" data-jdp type="text" name="expired_date" value="<?php echo Helper::toJalali($vip_user_data['expired_date'], '-') ?>" placeholder="تاریخ اتمام..." aria-label="100">
                </div>

                <div class="uk-width-1-4@s">
                    <select class="uk-select" aria-label="Select" name="status">
                        <option value="0" <?php echo selected($vip_user_data['status'], 0) ?>>غیر فعال</option>
                        <option value="1" <?php echo selected($vip_user_data['status'], 1) ?>>فعال</option>

                    </select>
                </div>

                <div class="uk-width-1-4@s">
                    <button type="submit" name="update-vip-user" class="uk-button uk-button-primary">بروز رسانی</button>
                    <?php wp_nonce_field('update_vip_user', '_nonce_update_vip_user'); ?>
                </div>
            </form>
        </div>
<?php
    }
}
/*Update VIP User*/
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['update-vip-user'])) {
    if (isset($_POST['_nonce_update_vip_user']) && !wp_verify_nonce($_POST['_nonce_update_vip_user'], 'update_vip_user')) {
        return false;
    }
    $new_user_data = [
        'account_type' => sanitize_text_field($_POST['account_type']),
        'start_date' => Helper::toGregorian(sanitize_text_field($_POST['start_date']), '-'),
        'expired_date' => Helper::toGregorian(sanitize_text_field($_POST['expired_date']), '-'),
        'status' => sanitize_text_field($_POST['status'])
    ];
    $user_id = intval($_GET['id']);
    update_user_meta($user_id, '_vip', $new_user_data);
}

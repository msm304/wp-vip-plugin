<div id="modal-sections" uk-modal>
    <div class="uk-modal-dialog">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <div class="uk-modal-header">
            <h5>اضافه کردن کاربر ویژه</h5>
        </div>
        <div class="uk-modal-body">
            <form method="post" action="" class="uk-grid-small" uk-grid>

                <div class="uk-width-1-1@s">
                    <input class="uk-input" name="user_email" type="text" value="" placeholder="ایمیل">
                </div>

                <div class="uk-width-1-2@s">
                    <select class="uk-select" name="account_type" aria-label="Select">
                        <option value="1">طلایی</option>
                        <option value="2">نقره ای</option>
                        <option value="3">برنزی</option>
                    </select>
                </div>

                <div class="uk-width-1-2@s">
                    <input class="uk-input" name="start_date" type="text" value="" placeholder="تاریخ شروع" data-jdp>
                </div>

                <div class="uk-width-1-2@s">
                    <input class="uk-input" data-jdp type="text" name="expired_date" value="" placeholder="تاریخ اتمام" aria-label="100">
                </div>

                <div class="uk-width-1-2@s">
                    <select class="uk-select" aria-label="Select" name="status">
                        <option value="0">غیر فعال</option>
                        <option value="1">فعال</option>

                    </select>
                </div>

        </div>
        <div class="uk-modal-footer uk-text-right">
            <div class="uk-width-1-2@s">
                <button type="submit" name="add-vip-user" value="add-user" class="uk-button uk-button-primary">افزودن کاربر</button>
                <?php wp_nonce_field('add_vip_user', '_nonce_add_vip_user'); ?>
            </div>
        </div>
        </form>
    </div>
</div>

<?php

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['add-vip-user'])) {
    if (isset($_POST['_nonce_add_vip_user']) && !wp_verify_nonce($_POST['_nonce_add_vip_user'], 'add_vip_user')) {
        return false;
    }
    foreach ($_POST as $post) {
        if (empty($post)) {
            // var_dump('تکمیل تمامی فیلدها الزامی می باشد!');
            FlashMessage::add_Msg('تکمیل تمامی فیلدها الزامی می باشد!', 0);
            return;
        }
    }
    $user_email = sanitize_text_field($_POST['user_email']);
    $user_info = get_user_by('email', $user_email);
    $vip_user_date = [
        'account_type' => sanitize_text_field($_POST['account_type']),
        'start_date' => Helper::toGregorian(sanitize_text_field($_POST['start_date']), '-'),
        'expired_date' => Helper::toGregorian(sanitize_text_field($_POST['expired_date']), '-'),
        'status' => sanitize_text_field($_POST['status'])
    ];
    $add_new_vip_user = update_user_meta($user_info->ID, '_vip', $vip_user_date);
    if ($add_new_vip_user) {
        FlashMessage::add_Msg('کاربر ویژه مورد نظر با موفقیت اضافه گردید.',  1);
    } else {
        FlashMessage::add_Msg('خطایی در افزودن کاربر ویژه جدید رخ داده است.', 0);
    }
}

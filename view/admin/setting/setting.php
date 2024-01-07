<?php
if (!current_user_can('manage_options')) {
    return;
}

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['save_vip_setting'])) {
    if (isset($_POST['_nonce_add_vip_setting']) && !wp_verify_nonce($_POST['_nonce_add_vip_setting'], 'add_vip_setting')) {
        return false;
    }
    foreach ($_POST as $post) {
        if ($post == '') {
            FlashMessage::add_Msg('تکمیل تمامی فیلدها الزامی است.', 0);
        }
    }

    $data = [
        'merchant_id' => sanitize_text_field($_POST['merchant_id']),
        'checkout' => sanitize_text_field($_POST['checkout']),
        'callback_url' => sanitize_text_field($_POST['callback_url']),
        'gateway' => sanitize_text_field($_POST['gateway'])
    ];
    $save = update_option('_vip_setting', $data);
    if ($save) {
        FlashMessage::add_Msg('اطلاعات وارد شده با موفقیت ذخیره شد.', 1);
    } else {
        FlashMessage::add_Msg('خطایی در ثبت اطلاعات رخ داده است.', 0);
    }
}
?>

<div class="uk-container uk-container-expand">
    <div class="uk-flex-middle">
        <h3 class="uk-margin-top"><?php echo esc_html(get_admin_page_title()) ?></h3>
    </div>
    <?php echo FlashMessage::show_Msg(); ?>
    <form action="" method="post" class="uk-grid-small" uk-grid>

        <div class="uk-width-1-4@s">
            <label class="uk-display-block uk-margin-bottom" for="merchant-id">مرچنت آی دی</label>
            <input id="merchant-id" class="uk-input" type="text" name="merchant_id" value="<?php echo get_option('_vip_setting')['merchant_id'] ?>" placeholder="مرچنت آی دی درگاه پرداخت">
        </div>

        <div class="uk-width-1-4@s">
            <label class="uk-display-block uk-margin-bottom" for="checkout">نامک برگه اتصال به درگاه پرداخت</label>
            <input id="checkout" class="uk-input" type="text" name="checkout" value="<?php echo get_option('_vip_setting')['checkout'] ?>" placeholder="نامک برگه اتصال به درگاه پرداخت">
        </div>

        <div class="uk-width-1-4@s">
            <label class="uk-display-block uk-margin-bottom" for="callback-url">نامک برگه بازگشت از درگاه پرداخت</label>
            <input id="callback-url" class="uk-input" type="text" name="callback_url" value="<?php echo get_option('_vip_setting')['callback_url'] ?>" placeholder="نامک برگه بازگشت از درگاه پرداخت">
        </div>

        <div class="uk-width-1-4@s">
            <label class="uk-display-block uk-margin-bottom" for="gateway">نامک برگه واسط درگاه پرداخت</label>
            <input id="gateway" class="uk-input" type="text" name="gateway" value="<?php echo get_option('_vip_setting')['gateway'] ?>" placeholder="نامک برگه واسط درگاه پرداخت">
        </div>


        <input type="hidden" class="id">
        <div class="uk-width-1-4@s">
            <label class="uk-display-block uk-margin-bottom">&nbsp;</label>
            <button type="submit" value="add-user" name="save_vip_setting" class="uk-input uk-button uk-button-primary">ثبت</button>
            <?php wp_nonce_field('add_vip_setting', '_nonce_add_vip_setting') ?>
        </div>
    </form>
</div>
<?php

function vip_payment_result()
{
    if(!is_user_logged_in() || empty($_GET['status']) || $_GET['status'] != 2) {
        wp_redirect(home_url());
    }
    // echo 'result';
    Payment::setter(Session::get('user_plan_data'));
    Payment::payment_result();

?>
    <div class="checkout-wrapper">
        <p class="payment-title">رسید پرداخت جهت اکانت vip - پلن <?php echo Helper::accountType(Session::get('user_plan_data')['plan_type']) ?></p>
        <div class="order-details">
            <span>شماره سفارش<span class="order-number"><?php echo Session::get('user_plan_data')['order_number'] ?></span></span>
            <span>تاریخ سفارش<span class="order-date"><?php echo jdate('Y/m/d') ?></span></span>
        </div>
        <div class="pric-pay-wrapper">
            <span>مبلغ پرداخت شده </span>
            <span class="price"><?php echo Session::get('user_plan_data')['price'] ?> <span>تومان</span></span>
        </div>
        <div class="pay-result">
            <div class="track-id">
                <span>شناسه مرجع</span>
                <span><?php echo Payment::get_refNmber() ?></span>
            </div>
            <a href="<?php echo site_url() ?>">بازگشت به سایت</a>
        </div>
    </div>
<?php
    Session::unset('user_plan_data');
}
add_shortcode('vip-payment-result', 'vip_payment_result');

<?php
function vip_checkout()
{
    var_dump(Session::get('user_plan_data'));
?>
    <div class="checkout-wrapper">
        <p class="checkout-title">پرداخت جهت اکانت vip - پلن <?php echo Helper::accountType(Session::get('user_plan_data')['plan_type']) ?></p>
        <div class="order-details">
            <span>شماره سفارش<span class="order-number"><?php echo Session::get('user_plan_data')['order_number'] ?></span></span>
            <span>تاریخ سفارش<span class="order-date"><?php echo jdate('Y/m/d') ?></span></span>
        </div>
        <div class="price-wrapper">
            <span>مبلغ قابل پرداخت </span>
            <span class="price"><?php echo Session::get('user_plan_data')['price'] ?> <span>تومان</span></span>
        </div>
        <div class="pay">
            <form action="<?php echo htmlspecialchars(get_the_permalink()) ?>" method="post">
                <input type="submit" name="pay" value="پرداخت">
            </form>
        </div>
    </div>
<?php
    if (isset($_POST['pay'])) {
        var_dump(Session::get('user_plan_data'));
    }
}
add_shortcode('vip-checkout', 'vip_checkout');

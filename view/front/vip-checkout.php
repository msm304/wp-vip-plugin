<?php
function vip_checkout()
{
    $result = Payment::gateway();
    var_dump($result);
?>
    <div class="checkout-wrapper">
        <p class="checkout-title">پرداخت جهت اکانت vip - پلن برنزی</p>
        <div class="order-details">
            <span>شماره سفارش<span class="order-number">54350</span></span>
            <span>تاریخ سفارش<span class="order-date">۱۴۰۳-۰۹-۱۲</span></span>
        </div>
        <div class="price-wrapper">
            <span>مبلغ قابل پرداخت </span>
            <span class="price">۱۴۹۰۰۰ <span>تومان</span></span>
        </div>
        <div class="pay">
            <form action="<?php echo htmlspecialchars(get_the_permalink()) ?>" method="post">
                <input type="submit" name="pay" value="پرداخت">
            </form>
        </div>
    </div>
<?php
}
add_shortcode('vip-checkout', 'vip_checkout');

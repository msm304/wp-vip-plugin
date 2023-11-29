<?php
function vip_checkout()
{
    if(!isset($_POST['plan_id'])){
        wp_redirect(home_url());
    }
    // $result = Payment::gateway();
    // var_dump($result);
    $plan_id = $_POST['plan_id'];
    $plan = new Plan();
    $plan = $plan->find_by_id($plan_id);
?>
    <div class="checkout-wrapper">
        <p class="checkout-title">پرداخت جهت اکانت vip - پلن <?php echo Helper::accountType($plan->type) ?></p>
        <div class="order-details">
            <span>شماره سفارش<span class="order-number"><?php echo Helper::invoceNumber() ?></span></span>
            <span>تاریخ سفارش<span class="order-date"><?php echo jdate('Y/m/d') ?></span></span>
        </div>
        <div class="price-wrapper">
            <span>مبلغ قابل پرداخت </span>
            <span class="price"><?php echo $plan->price ?> <span>تومان</span></span>
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

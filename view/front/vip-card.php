<?php
function wp_vip_layout()
{
    $plan = new Plan();
?>
    <section class="bg-light">
        <div class="container">
            <!-- ============================ Page Title Start================================== -->
            <div class="page-title mb-5">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <h1 class="breadcrumb-title">اشتراک VIP</h1>
                    </div>
                </div>
            </div>
            <!-- ============================ Page Title End ================================== -->
            <div class="row">
                <!-- Single Package -->
                <?php $items = $plan->find(); ?>
                <?php if ($items) : ?>
                    <?php foreach ($items as $item) : ?>
                        <div class="col-lg-4 col-md-4">
                            <div class="packages_wrapping <?php echo $item->recommended == 1 ? 'recommended' : 'bg-white' ?>">
                                <div class="packages_headers">
                                    <i class="lni-layers"></i>
                                    <h4 class="packages_pr_title">پکیج <?php echo Helper::accountType($item->type) ?></h4>
                                    <span class="packages_price-subtitle">با پکیج <?php echo Helper::accountType($item->type) ?> شروع کنید!</span>
                                </div>
                                <div class="packages_price">
                                    <h4 class="pr-value"><?php echo Helper::dropZero($item->price) ?></h4>
                                </div>
                                <div class="packages_middlebody">
                                    <ul>
                                        <li><?php echo Helper::benefits($item->benefits) ?></li>
                                    </ul>
                                </div>
                                <div class="packages_bottombody">
                                    <form action="<?php echo site_url('vip-checkout'); ?>" method="post">
                                        <input type="hidden" value="<?php echo $item->id ?>">
                                        <input type="submit" value="انتخاب" name="plan-id" class="btn-pricing">
                                        <?php wp_nonce_field() ?>
                                    </form>
                                </div>

                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <div>تاکنون پلنی ایجاد نشده است.</div>
                <?php endif; ?>
            </div>

        </div>

    </section>
<?php
}

add_shortcode('vip-card', 'wp_vip_layout');

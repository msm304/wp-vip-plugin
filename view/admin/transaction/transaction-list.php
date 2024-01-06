<div class="uk-container-expand">
    <div class="uk-flex-middle">
        <h3 class="uk-margin-top"><?php echo esc_html(get_admin_page_title()) ?></h3>
        <a class="uk-button uk-button-primary" href="#modal-sections-add" uk-toggle>افزودن تراکنش</a>
    </div>
    <?php echo FlashMessage::show_Msg() ?>
    <table class="uk-table uk-table-striped uk-table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>نام و نام خانوادگی</th>
                <th>ایمیل</th>
                <th>مبلغ پرداختی</th>
                <th>شماره سفارش</th>
                <th>شماره تراکنش</th>
                <th>وضعیت پرداخت</th>
                <th>تاریخ پرداخت</th>
                <th>نوع پلن ویژه</th>
                <th>عملیات</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $transaction = new Transaction();
            $items = $transaction->find();
            if ($items) :
                foreach ($items as $item) :
            ?>
                    <tr>
                        <td><?php echo $item->user_id ?></td>
                        <td><?php echo $item->first_name . ' ' . $item->last_name ?></td>
                        <td><?php echo $item->email ?></td>
                        <td><?php echo $item->price ?></td>
                        <td><?php echo $item->order_number ?></td>
                        <td><?php echo $item->refNumber ?></td>
                        <td><?php echo Helper::vipTransactioStatus($item->status) ?></td>
                        <td><?php echo Helper::toJalali($item->create_at, '-') ?></td>
                        <td><?php echo Helper::accountType($item->plan_type) ?></td>
                        <td>
                            <a href="<?php echo add_query_arg(['action' => 'delete', 'id' => $item->id]) ?>" uk-tooltip="حذف تراکنش"><span uk-icon="trash"></span></a>
                            <a class="find-transaction" href="#modal-sections-update" uk-toggle uk-tooltip="ویرایش تراکنش" data-id="<?php echo $item->id ?>"><span uk-icon="pencil" class="vip-pencil"></span><span uk-icon="refresh" class="vip-loading-icon"></span></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <div class="uk-alert-warning">تاکنون تراکنشی ثبت نشده است.</div>
            <?php endif; ?>
        </tbody>
    </table>
</div>
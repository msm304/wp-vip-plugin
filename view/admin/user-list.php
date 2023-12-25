<div class="uk-container-expand">
    <h1 class="uk-margin-top"><?php echo esc_html(get_admin_page_title()) ?></h1>
    <table class="uk-table uk-table-striped uk-table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>نام و نام خانوادگی</th>
                <th>ایمیل</th>
                <th>نوع اکانت</th>
                <th>تاریخ شروع</th>
                <th>تاریخ اتمام</th>
                <th>زمان باقیمانده</th>
                <th>وضعیت اکانت</th>
                <th>عملیات</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $users = User::get_vip_users();
            if ($users) :
                foreach ($users as $user) :
                    $user_vip_data = get_user_meta($user->ID, '_vip', true);
                    // $user_vip_status = get_user_meta($user->ID, '_vip_status', true);
            ?>
                    <tr>
                        <td><?php echo $user->ID ?></td>
                        <td><?php echo $user->display_name ?></td>
                        <td><?php echo $user->user_email ?></td>
                        <td><?php echo Helper::accountType($user_vip_data['account_type']) ?></td>
                        <td><?php echo Helper::toJalali($user_vip_data['start_date'], '/') ?></td>
                        <td><?php echo Helper::toJalali($user_vip_data['expired_date'], '/') ?></td>
                        <td><?php echo Helper::calculateRemainingVipCredit($user_vip_data['expired_date']) ?></td>
                        <td><?php echo Helper::vipStatus($user_vip_data['status']) ?></td>
                        <td>
                            <span uk-icon="trash"></span>
                            <span uk-icon="pencil"></span>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <div class="uk-alert-warning">تاکنون کاربر VIP ثبت نشده است.</div>
            <?php endif; ?>
        </tbody>
    </table>
</div>
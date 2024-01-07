<?php
add_action('admin_menu', 'vip_register_menu');
function vip_register_menu()
{
    add_menu_page(
        'پلاگین اشتراک ویژه',
        'پلاگین اشتراک ویژه',
        'manage_options',
        'vip_home',
        'wp_vip_home_handler'
    );
    add_submenu_page(
        'vip_home',
        'لیست کاربران',
        'لیست کاربران',
        'manage_options',
        'vip_users',
        'wp_vip_user_list_handler'

    );
    add_submenu_page(
        'vip_home',
        'لیست تراکنش ها',
        'لیست تراکنش ها',
        'manage_options',
        'vip_transactions',
        'wp_vip_transactions_list_handler'

    );
    add_submenu_page(
        'vip_home',
        'پلن های VIP',
        'پلن های VIP',
        'manage_options',
        'vip_plans',
        'wp_vip_plan_list_handler'

    );
    add_submenu_page(
        'vip_home',
        'تنظیمات',
        'تنظیمات',
        'manage_options',
        'vip_settings',
        'wp_vip_settings_handler'

    );
}

function wp_vip_home_handler()
{
    echo 'vip home';
}

function wp_vip_user_list_handler()
{
    include_once VIP_PLUGIN_DIR . 'view/admin/user/delete-user.php';
    include_once VIP_PLUGIN_DIR . 'view/admin/user/update-user.php';
    include_once VIP_PLUGIN_DIR . 'view/admin/user/add-user.php';
    include_once VIP_PLUGIN_DIR . 'view/admin/user/user-list.php';
}

function wp_vip_transactions_list_handler()
{
    include_once VIP_PLUGIN_DIR . 'view/admin/transaction/delete-transaction.php';
    include_once VIP_PLUGIN_DIR . 'view/admin/transaction/update-transaction.php';
    include_once VIP_PLUGIN_DIR . 'view/admin/transaction/add-transaction.php';
    include_once VIP_PLUGIN_DIR . 'view/admin/transaction/transaction-list.php';
}

function wp_vip_plan_list_handler()
{
    echo 'vip plans';
}

function wp_vip_settings_handler()
{
    include_once VIP_PLUGIN_DIR . 'view/admin/setting/setting.php';
}

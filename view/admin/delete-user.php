<?php

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
        $user_id = intval($_GET['id']);
        delete_user_meta($user_id, '_vip');
    }
}

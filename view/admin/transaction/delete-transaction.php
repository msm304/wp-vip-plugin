<?php
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
        $transaction_id = intval($_GET['id']);
        $transaction = new Transaction();
        $transaction = $transaction->delete($transaction_id);
        if ($transaction) {
            FlashMessage::add_Msg('تراکنش مورد نظر با موفقیت حذف شد.', 1);
        } else {
            FlashMessage::add_Msg('خطایی در حذف تراکنش رخ داده است.', 0);
        }
    }
}

<?php

use ParagonIE\Sodium\Core\Curve25519\Ge\P2;

class Transaction
{
    private $db;
    private $Table;

    public function __construct()
    {
        global $wpdb;
        $this->db = $wpdb;
        $this->Table = $this->db->prefix . 'vip_transaction';
        add_action('wp_ajax_findById', [$this, 'findById']);
        add_action('wp_ajax_updateById', [$this, 'updateById']);
        add_action('wp_ajax_saveTransactionByAdmin', [$this, 'saveTransactionByAdmin']);
    }

    public function save($data)
    {
        $data = [
            'user_id' => $data['user_id'],
            'plan_type' => $data['plan_type'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'price' => $data['price'],
            'order_number' => $data['order_number']
        ];
        $format = ['%d', '%d', '%s', '%s', '%s', '%s'];
        $this->db->insert($this->Table, $data, $format);
    }

    public function update($refNumber, $order_number)
    {
        $data = [
            'refNumber' => $refNumber,
            'status' => 1
        ];
        $format = ['%s', '%d'];
        $where = ['order_number' => $order_number];
        $where_format = ['%s'];
        $this->db->update($this->Table, $data, $where, $format, $where_format);
    }

    public function find()
    {
        $stmt = $this->db->get_results("SELECT * FROM $this->Table ORDER BY id DESC");
        if ($stmt) {
            return $stmt;
        }
        return false;
    }

    public function delete($id)
    {
        $where = ['id' => $id];
        $where_format = ['%d'];
        $stmt = $this->db->delete($this->Table, $where, $where_format);
        if ($stmt) {
            return true;
        }
        return false;
    }

    public function findById()
    {
        if (isset($_POST['_nonce']) && !wp_verify_nonce($_POST['_nonce'])) {
            die('access denied !!!');
        }
        $t_id = intval($_POST['t_id']);
        $stmt = $this->db->get_row($this->db->prepare("SELECT * FROM {$this->Table} WHERE id=%d", $t_id));
        if ($stmt) {
            wp_send_json([
                'success' => true,
                'plan_type' => $stmt->plan_type,
                'price' => $stmt->price,
                'order_number' => $stmt->order_number,
                'refNumber' => $stmt->refNumber,
                'status' => $stmt->status,
                'id' => $stmt->id
            ], 200);
        } else {
            wp_send_json([
                'error' => true,
                'message' => 'خطایی در دریافت اطلاعات رخ داده است.',
            ]);
        }
    }

    public function updateById()
    {
        if (isset($_POST['_nonce']) && !wp_verify_nonce($_POST['_nonce'])) {
            die('access denied !!!');
        }
        if (empty($_POST['t_price']) || $_POST['t_plan_type'] == '' || empty($_POST['t_order_number']) || $_POST['t_status'] == '') {
            wp_send_json([
                'error' => true,
                'message' => 'تکمیل تمامی فیلدها بجز شماره تراکنش الزامی است.'
            ], 403);
        }
        $id = intval($_POST['t_id']);
        $data = [
            'price' => sanitize_text_field($_POST['t_price']),
            'plan_type' => sanitize_text_field($_POST['t_plan_type']),
            'order_number' => sanitize_text_field($_POST['t_order_number']),
            'refNumber' => sanitize_text_field($_POST['t_refNumber']),
            'status' => sanitize_text_field($_POST['t_status']),
        ];
        $format = ['%s', '%s', '%s', '%s', '%s'];
        $where = ['id' => $id];
        $where_format = ['%d'];
        $stmt = $this->db->update($this->Table, $data, $where, $format, $where_format);
        if ($stmt) {
            wp_send_json([
                'success' => true,
                'message' => 'بروزرسانی با موفقیت انجام شد.'
            ], 200);
        } else {
            wp_send_json([
                'error' => true,
                'message' => 'خطایی در بروزرسانی رخ داده است.'
            ], 403);
        }
    }

    public function saveTransactionByAdmin()
    {
        if (isset($_POST['_nonce']) && !wp_verify_nonce($_POST['_nonce'])) {
            die('access denied !!!');
        }
        foreach ($_POST as $post) {
            if ($post == '') {
                wp_send_json([
                    'error' => true,
                    'message' => 'تکمیل تمامی فیلدها الزامی است.'
                ], 403);
            }
        }
        $user_email = sanitize_text_field($_POST['email']);
        $user_id = get_user_by('email', $user_email);
        if (!$user_id) {
            wp_send_json([
                'error' => true,
                'message' => 'کاربر با این ایمیل یافت نشد.'
            ], 403);
        }
        $user_id = $user_id->ID;
        $data = [
            'user_id' => $user_id,
            'plan_type' => sanitize_text_field($_POST['t_plan_type']),
            'first_name' => sanitize_text_field($_POST['first_name']),
            'last_name' => sanitize_text_field($_POST['last_name']),
            'email' => sanitize_text_field($_POST['email']),
            'price' => sanitize_text_field($_POST['price']),
            'order_number' => sanitize_text_field($_POST['order_number']),
            'refNumber' => sanitize_text_field($_POST['refNumber']),
            'status' => sanitize_text_field($_POST['status']),
        ];
        $format = ['%d', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s'];
        $stmt = $this->db->insert($this->Table, $data, $format);
        if ($stmt) {
            wp_send_json([
                'success' => true,
                'message' => 'تراکنش با موفقیت ثبت شد.'
            ], 200);
        } else {
            wp_send_json([
                'error' => true,
                'message' => 'خطایی در ثبت تراکنش رخ داده است.'
            ], 403);
        }
    }
}

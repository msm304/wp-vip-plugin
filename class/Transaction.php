<?php

class Transaction
{
    private $db;
    private $Table;

    public function __construct()
    {
        global $wpdb;
        $this->db = $wpdb;
        $this->Table = $this->db->prefix . 'vip_transaction';
    }

    public function save($data)
    {
        $data = [
            'user_id' => $data['user_id'],
            'plan_type' => $data['plan_type'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
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
}

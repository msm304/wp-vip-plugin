<?php

class Plan
{
    private $db;
    private $vipTable;

    public function __construct()
    {
        global $wpdb;
        $this->db = $wpdb;
        $this->vipTable = $this->db->prefix . 'vip_plan';
    }

    public function find()
    {
        $stmt = $this->db->get_results("SELECT * FROM {$this->vipTable} ORDER BY id DESC");
        if ($stmt) {
            return $stmt;
        }
        return false;
    }

    public function find_by_id($plan_id)
    {
        $stmt = $this->db->get_row($this->db->prepare("SELECT id,type,price FROM {$this->vipTable} WHERE id = %d", $plan_id));
        if ($stmt) {
            return $stmt;
        }
        return false;
    }
}

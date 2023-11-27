<?php

class Plan
{
    private $db;
    private $vipTable;

    public function __construct()
    {
        global $wpdb;
        $this->db = $wpdb;
        $this->vipTable = $this->db->prefix . 'vip';
    }

    public function find()
    {
        $stmt = $this->db->get_results("SELECT * FROM {$this->vipTable} ORDER BY id DESC");
        if($stmt){
            return $stmt;
        }
        return false;
    }
}

<?php

class Resource extends CI_Model {

    var $title;
    var $url;

    function __construct() {
        parent::__construct();
    }

    function get_all() {
        $this->db->select('title, url, t2.name as category');
        $this->db->from('yyc_resources as t1');
        $this->db->join('yyc_resource_category as t2', 't2.id = t1.category_id');
        $q = $this->db->get();
        return $q->result();
    }

}
<?php


class VisitsApiModel{

    protected $db;

    function __construct() {
        $this->db = new PDO('pgsql:host='.MYSQL_HOST.';dbname='.MYSQL_DB, MYSQL_USER, MYSQL_PASS);
    }

    public function 

}


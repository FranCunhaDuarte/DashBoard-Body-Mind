<?php

require_once 'config.php';


class HomeApiModel{
    protected $db;
    
    function __construct() {
        $this->db = new PDO('pgsql:host='.MYSQL_HOST.';dbname='.MYSQL_DB, MYSQL_USER, MYSQL_PASS);
    }

    public function getBalance($date,$actualDate){
        $query=$this->db->prepare('SELECT SUM(total_amount) FROM renewed WHERE renewed_date BETWEEN ? AND ?');
        $query->execute([$date,$actualDate]);
        $balance=$query->fetch(PDO::FETCH_OBJ);
        return $balance;
    }

    public function getVisits($date,$actualDate){
        $query=$this->db->prepare('SELECT COUNT(*) FROM visits WHERE date_visit BETWEEN ? AND ?');
        $query->execute([$date,$actualDate]);
        $visits=$query->fetch(PDO::FETCH_OBJ);
        return $visits;
    }

    public function getNewMembers($date,$actualDate){
        $query=$this->db->prepare('SELECT COUNT(*) FROM member WHERE join_date BETWEEN ? AND ?');
        $query->execute([$date,$actualDate]);
        $newMembers=$query->fetch(PDO::FETCH_OBJ);
        return $newMembers;
    }
    
}

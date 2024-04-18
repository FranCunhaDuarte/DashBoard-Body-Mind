<?php

require_once 'config.php';

class VisitsApiModel{

    protected $db;

    function __construct() {
        $this->db = new PDO('pgsql:host='.MYSQL_HOST.';dbname='.MYSQL_DB, MYSQL_USER, MYSQL_PASS);
    }

    public function getVisits($date){
        $query=$this->db->prepare("SELECT * FROM visits WHERE date_visits BETWEEN ? AND ?");
        $query->execute([$date,$actualDate];)
        $visits=$query->FetchAll(PDO::FETCH_OBJ);
        return $visits;
    }

    public function insertVisit($id_member,$actualDate){
        $query=$this->db->prepare("INSERT INTO visits (id_member,date_visits) VALUES (?,?)");
        $query->execute([$id_member,$actualDate]);
    }

    
}


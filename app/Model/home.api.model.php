<?php
declare(strict_types=1); // a nivel archivo y arriba del todo
require_once 'config.php';

class HomeApiModel{

    protected $db;
    
    function __construct() {
        $this->db = new PDO('pgsql:host='.MYSQL_HOST.';dbname='.MYSQL_DB, MYSQL_USER, MYSQL_PASS);
    }

    public function getBalance(DateTime $date, $actualDate){
        $query=$this->db->prepare('SELECT SUM(total_amount) FROM renewed WHERE renewed_date BETWEEN ? AND ?');
        $query->execute([$date,$actualDate]);
        $balance=$query->fetch(PDO::FETCH_OBJ);
        return $balance;
    }

    public function getVisits(DateTime $date,$actualDate){
        $query=$this->db->prepare('SELECT COUNT(*) FROM visits WHERE date_visit BETWEEN ? AND ?');
        $query->execute([$date,$actualDate]);
        $visits=$query->fetch(PDO::FETCH_OBJ);
        return $visits;
    }

    public function getNewMembers(DateTime $date,$actualDate){
        $query=$this->db->prepare('SELECT COUNT(*) FROM member WHERE join_date BETWEEN ? AND ?');
        $query->execute([$date,$actualDate]);
        $newMembers=$query->fetch(PDO::FETCH_OBJ);
        return $newMembers;
    }

    public function getMemberships(){
        $query=$this->db->prepare('SELECT * FROM membership');
        $query->execute();
        $memberships=$query->fetchAll(PDO::FETCH_OBJ);
        return $memberships;
    }

    public function getMembership(int $id){
        $query=$this->db->prepare('SELECT * FROM membership WHERE id=?');
        $query->execute();
        $membership=$query->fetchAll(PDO::FETCH_OBJ);
        return $membership;
    }

    public function addMembership(String $name,int $price){
        $query=$this->db->prepare('INSERT INTO membership (name,price) VALUES (?,?)');
        $query->execute([$name,$price]);
        return $this->db->lastInsertId();
    }

}

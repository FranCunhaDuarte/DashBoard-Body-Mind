<?php

require_once 'config.php';

class PaymentApiModel{

    protected $db;

    public function __construct(){
        $this->db = new PDO('mysql:host=localhost;'.'dbname=db_gym;charset=utf8', 'root', '');
    }

    public function getPayments($date,$actualDate){
        $query = $this->db->prepare('SELECT * FROM renewed WHERE renewed_date BETWEEN ? AND ?');
        $query->execute([$date,$actualDate]);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function madePayment($id_member,$id_membership,$total_amount,$renewed_date){
        $query = $this->db->prepare('INSERT INTO renewed (id_member,id_membership,total_amount,renewed_date) VALUES (?,?,?,?)');
        $query->execute([$id_member,$id_membership,$total_amount,$renewed_date]);
    }

    

}


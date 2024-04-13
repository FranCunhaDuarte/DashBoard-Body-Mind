<?php

require_once 'config.php';

class MembersApiModel{

    protected $db;
    
    function __construct() {
        $this->db = new PDO('pgsql:host='.MYSQL_HOST.';dbname='.MYSQL_DB, MYSQL_USER, MYSQL_PASS);
    }

    public function getMembers(){
        $query=$this->db->prepare('SELECT * FROM member');
        $query->execute();
        $users=$query->fetchAll(PDO::FETCH_OBJ);
        return $users;
    }

    public function getMember($id){
        $query=$this->db->prepare('SELECT * FROM member WHERE id_member=?');
        $query->execute([$id]);
        $user=$query->fetch(PDO::FETCH_OBJ);
        return $user;
    }

    

}
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

    public function verifyId($id){
        $query=$this->db->prepare('SELECT * FROM member WHERE id_real=?');
        $query->execute([$id]);
        $user=$query->fetch(PDO::FETCH_OBJ);
        return $user;
    }

    public function verifyEmail($email){
        $query=$this->db->prepare('SELECT * FROM member WHERE email=?');
        $query->execute([$email]);
        $user=$query->fetch(PDO::FETCH_OBJ);
        return $user;
    }

    public function addMember($id,$name,$surname,$email,$phoneNumber,$birthdate,$insaurance,$joinDate){
        $query=$this->db->prepare('INSERT INTO member (id_real, name, surname, email, phone_number, birthdate, insaurance, join_date, expires_date) VALUES (?,?,?,?,?,?,?,?,null)');
        $query->execute([$id,$name,$surname,$email,$phoneNumber,$birthdate,$insaurance,$joinDate]);
        return $query;
    }
    
    public function deleteMember($id){
        $query=$this->db->prepare('DELETE FROM member WHERE id_member=?');
        $query->execute([$id]);
        return $query;
    }

    public function updateMember($id_member,$id,$name,$surname,$email,$phoneNumber,$birthdate,$insaurance){
        $query=$this->db->prepare('UPDATE member SET id_real=?, name=?, surname=?, email=?, phone_number=?, birthdate=?, insaurance=? WHERE id_member=?');
        $query->execute([$id,$name,$surname,$email,$phoneNumber,$birthdate,$insaurance,$id_member]);
        return $query;
    }

    

}
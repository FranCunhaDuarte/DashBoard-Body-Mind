<?php

require_once 'api.controller.php';
require_once 'app/Model/members.api.model.php';

class MembersApiController extends ApiController{

    private $model;

    public function __construct(){
        parent::__construct();
        $this->model = new MembersApiModel();
    }

    public function getMembers($params=[]){
        if(empty($params)){
            $members=$this->model->getMembers();
            return $this->view->response($members,200);
        }
        if($params[':ID']){
            $member=$this->model->getMember($params[':ID']);
            if($member){
                return $this->view->response($member,200);
            }
            return $this->view->response("Member do not exist.",404); 
        }
        $this->view->response("No records yet.",200);
    }
    
    public function addMember($params=[]){
        $body = $this->getData();
        $id=$body->id;
        $name=$body->name;
        $surname=$body->surname;
        $email=$body->email;
        $phoneNumber=$body->phoneNumber;
        $birthdate=$body->birthdate;
        $insaurance=$body->insaurance;
        $joinDate= new DateTime("Today", new DateTimeZone("America/Argentina/Buenos_Aires"));
        if(!$body){
            return $this->view->response("No data found.",404);
        }
        if( !isset($id) && !empty($id) &&
            !isset($name) && !empty($name) &&
            !isset($surname) && !empty($surname) &&
            !isset($email) && !empty($email) &&
            !isset($phoneNumber) && !empty($phoneNumber) &&
            !isset($birthdate) && !empty($birthdate) &&
            !isset($insaurance)){
            return $this->view->response("Missing data.",404);
        }
        if( !strlen($id) > 20 && !($birthdate->format('Y-m-d') == $joinDate->format('Y-m-d')) && !($birthdate >= $joinDate)
         &&
            !strlen($name) > 50 && !strlen($surname) > 100 && 
            !strlen($email) > 250 && !strlen($phoneNumber) > 30 &&
            !strlen($insaurance) > 100 && !filter_var($email, FILTER_VALIDATE_EMAIL)){
            return $this->view->response("Invalid data.",400);
        }
        if($this->model->verifyEmail($email)){
            return $this->view->response("Email already exists.",400);
        }
        if($this->model->verifyId($id)){
            return $this->view->response("ID already exists.",400);
        }
        $this->model->addMember($id,$name,$surname,$email,$phoneNumber,$birthdate->format('Y-m-d'),$insaurance,$joinDate->format('Y-m-d'));
    }

    public function deleteMember($id){
        if($id){
            $member=$this->model->getMember($id);
            if($member){
                $this->model->deleteMember($id);
                return $this->view->response("Member deleted.",200);
            }
            return $this->view->response("Member do not exist.",404); 
        }
    }


    public function updateMember(){
        $body = $this->getData();
        $id_member=$body->id_member;
        $id=$body->id;
        $name=$body->name;
        $surname=$body->surname;
        $email=$body->email;
        $phoneNumber=$body->phoneNumber;
        $birthdate=$body->birthdate;
        $insaurance=$body->insaurance;
        $joinDate= new DateTime("Today", new DateTimeZone("America/Argentina/Buenos_Aires"));
        if(!$body){
            return $this->view->response("No data found.",404);
        }
        if( !isset($id) && !empty($id) &&
            !isset($name) && !empty($name) &&
            !isset($surname) && !empty($surname) &&
            !isset($email) && !empty($email) &&
            !isset($phoneNumber) && !empty($phoneNumber) &&
            !isset($birthdate) && !empty($birthdate) &&
            !isset($insaurance)){
            return $this->view->response("Missing data.",404);
        }
        if( !strlen($id) > 20 && !($birthdate->format('Y-m-d') == $joinDate->format('Y-m-d')) && !($birthdate >= $joinDate)
         &&
            !strlen($name) > 50 && !strlen($surname) > 100 && 
            !strlen($email) > 250 && !strlen($phoneNumber) > 30 &&
            !strlen($insaurance) > 100 && !filter_var($email, FILTER_VALIDATE_EMAIL)){
            return $this->view->response("Invalid data.",400);
        }
        if($this->model->verifyEmail($email)){
            return $this->view->response("Email already exists.",400);
        }
        if($this->model->verifyId($id)){
            return $this->view->response("ID already exists.",400);
        }
        if(!$this->model->getMember($id_member)){
            return $this->view->response("Member do not exist.",404); 
        }
        $this->model->updateMember($id_member,$id,$name,$surname,$email,$phoneNumber,$birthdate->format('Y-m-d'),$insaurance);
    }

    
    
}
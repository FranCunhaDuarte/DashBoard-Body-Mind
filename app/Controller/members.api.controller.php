<?php

require_once 'api.controller.php';
require_once 'app/Model/users.api.model.php';

class MembersApiController extends ApiController{

    private $model;

    public function __construct(){
        parent::__construct();
        $this->model = new MembersApiModel();
    }

    public function getUsers($params=[]){
        if(empty($params['ID'])){
            $user=$this->model->getMember($params['ID']);
            if($user){
                return $this->view->response($user,200);
            }
            return $this->view->response("User not found",404);
        }
        $members=$this->model->getMembers();
        if($members){
            return $this->view->response($members,200);
        }
        $this->view->response("No records yet.",200);
    }


}
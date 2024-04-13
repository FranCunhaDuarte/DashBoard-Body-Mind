<?php

require_once 'app/Model/home.api.model.php';
require_once 'app/Controller/api.controller.php';

class DashBoardApiController extends ApiController{
    
    private $model;

    public function __construct(){
        parent::__construct();
        $this->model = new HomeApiModel();
    }

    public function getSummaryData($params=[]){
        $actualDate= new DateTime("Today", new DateTimeZone("America/Argentina/Buenos_Aires"));
        $date = new DateTime($params['DATE'], new DateTimeZone("America/Argentina/Buenos_Aires"));
        if($date>$actualDate&&$date->format('Y-m-d')!=$actualDate->format('Y-m-d')){
            return $this->view->response("Invalid date", 404);
        }
        $balance=$this->model->getBalance($date, $actualDate);
        $visits=$this->model->getVisits($date, $actualDate);
        $newMembers=$this->model->getNewMembers($date, $actualDate);
        if($balance&&$visits&&$newMembers){
            return $this->view->response([$balance,$visits,$newMembers],200);
        }
        $this->view->response("No records yet.",200);
    }

    

}




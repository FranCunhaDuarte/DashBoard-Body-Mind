<?php
declare(strict_types=1); // a nivel archivo y arriba del todo

require_once 'app/Model/home.api.model.php';
require_once 'app/Controller/api.controller.php';

class HomeApiController extends ApiController{
    
    private $model;

    public function __construct(){
        parent::__construct();
        $this->model = new HomeApiModel();
    }

    public function getSummaryData(DateTime $date){
        $actualDate= new DateTime("Today", new DateTimeZone("America/Argentina/Buenos_Aires"));
        $date = new DateTime($date, new DateTimeZone("America/Argentina/Buenos_Aires"));
        if($date->format('Y-m-d')!=$actualDate->format('Y-m-d')&&$date>$actualDate){
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

    public function getMemberships(){
        $memberships=$this->model->getMemberships();
        $this->view->response($memberships,200);
    }
    
    public function addMembership(String $name,float $price){
        $membership=$this->model->addMembership($name,$price);
        $this->view->response($membership,200);
    }

}




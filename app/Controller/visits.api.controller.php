<?php

require_once ('api.controller.php');

class VisitsApiController extends ApiController{

    private $model;

    public function __construct(){
        parent::__construct();
        $this->model = new VisitsApiModel();
    }

    public function getVisits($date){
        $actualDate= New DateTime("Today", new DateTimeZone("America/Argentina/Buenos_Aires"));
        $visits = $this->model->getVisits($date,$actualDate);
        if(!$visits){
            return $this->view->response("No visits found",404);
        }
        $this->view->response($visits,200);
    }

    public function insertVisit($id_member){
        $actualDate= New DateTime("Today", new DateTimeZone("America/Argentina/Buenos_Aires"));
        $this->model->insertVisit($id_member,$actualDate);
        $this->view->response("Visit added successfully",200);
    }
}




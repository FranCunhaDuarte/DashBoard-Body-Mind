<?php

require_once 'app/Model/home.api.model.php';
require_once 'app/Controller/api.controller.php';

class HomeApiController extends ApiController{
    
    private $model;

    public function __construct(){
        parent::__construct();
        $this->model = new HomeApiModel();
    }

    public function getSummaryData(){
        $balance=$this->model->getBalance();
        
    }

}




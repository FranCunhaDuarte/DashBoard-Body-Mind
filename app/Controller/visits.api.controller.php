<?php

require_once ('api.controller.php');

class VisitsApiController extends ApiController{

    private $model;

    public function __construct(){
        parent::__construct();
        $this->model = new VisitsApiModel();
    }

}




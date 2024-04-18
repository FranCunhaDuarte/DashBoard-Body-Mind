<?php

require_once 'app/model/paymentapi.controller.php';
require_once 'app/model/memberapi.controller.php';
require_once 'app/model/home.api.controller.php';

class PaymentApiController extends ApiController{
    
    private $model,$modelMembers,$modelHome;

    public function __construct(){
        parent::__construct();
        $this->model = new PaymentApiModel();
        $this->modelMembers = new MembersApiModel();
        $this->modelHome = new HomeApiModel();
    }



    public function getPayments($date){
        $actualDate= new DateTime("Today", new DateTimeZone("America/Argentina/Buenos_Aires"));
        $payments = $this->model->getPayments($date,$actualDate);
        if(!$payments){
            return $this->view->response("No payments found",404);
        }
        $this->view->response($payments,200);
    }

    public function madePayment($id_member,$id_membership){//,$total_months,$renewed_date){
        $member=$this->modelMembers->getMember($id_member);
        $membership=$this->modelHome->getMembership($id_membership);
        var_dump($membership);
        // if(!$member && !$membership){
        //     return $this->view->response("Member or membership not found.",404);
        // }
        // $this->model->madePayment($id_member,$id_membership,$membership,$renewed_date);
        // $this->view->response("Payment succesfull.",200);
        
    }


}



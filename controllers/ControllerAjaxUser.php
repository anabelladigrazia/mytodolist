<?php
require_once ROOT_PATH . 'services/ServiceUser.php';
require_once ROOT_PATH . 'services/ServiceItem.php';
class ControllerAjaxUser {
    protected $serviceUser;
    public function __construct() {
        $this->serviceUser = new ServiceUser();
    }

    public function login(){
        $username = filter_input(INPUT_POST, 'username');
        $password = filter_input(INPUT_POST, 'password');
        if($this->validateLogin($username, $password)){
            $user =$this->serviceUser->login($username, $password);        
            if($user){
                $_SESSION['username']=$user->getUserName();
                $_SESSION['userId']=$user->getId();
                http_response_code(200);
                $rta = array("state"=>true,"msj"=>"Ok");

            }else{
                http_response_code(400);
                $rta= array('state' => FALSE, 'msj' => 'Login failed. Try again.');

            }
        }else{
            http_response_code(400);
            $rta= array('state' => FALSE, 'msj' => 'Invalid data. Try again.');
        }
        echo json_encode($rta);
            
    }
    public function logout(){
        session_destroy();
            
    }
        
    private function validateLogin($username, $password){
        return $this->validateUsername($username) && $this->validatePassword($password);
    }
    private function validateUsername($value){
        $expresion = '/^[a-zA-Záéíóúñ\d_\d-]{2,30}$/i';
    	return preg_match($expresion, $value);
    }
    private function validatePassword($value){
        $expresion = '/^[a-zA-Záéíóúñ\d_\d-]{5,50}$/i';
    	return preg_match($expresion, $value);
    }
}






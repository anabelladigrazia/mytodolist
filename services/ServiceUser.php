<?php
require_once ROOT_PATH . 'daos/UserDao.php';
class ServiceUser {
    
    protected $userDao;
    
    function __construct() {
        $this->userDao = new UserDao();
    }

    public function login($username, $password){
       
        return $this->userDao->userLogin($username, $password);        
    }
    public function user($userId){
       
        return $this->userDao->user($userId);        
    }
}

<?php
class User {
    protected $id;
    protected $username;
    protected $password;
    
    function __construct($parametros=NULL) {
        if($parametros){
            $this->id = $parametros['id'];
            $this->username = $parametros['username'];
            $this->password = $parametros['password'];
        }
    }
    function getId() {
        return $this->id;
    }

    function setId($id) {
        $this->id = $id;
    }

        
    function getUsername() {
        return $this->username;
    }

    function getPassword() {
        return $this->password;
    }

    function setUsername($username) {
        $this->username = $username;
    }

    function setPassword($password) {
        $this->password = $password;
    }



}

<?php

class Item {
    protected $id;
    protected $title;
    protected $dueDate;
    protected $description;
    protected $done;
    protected $userId;
    
    function __construct($parametros=NULL) {
        if($parametros){
            $this->id = $parametros['id'];
            $this->title = $parametros['title'];
            $this->dueDate = $parametros['dueDate'];
            $this->description = $parametros['description'];
            $this->done = $parametros['done'];
            $this->userId = $parametros['userId'];
        }
        
    }

    function getId() {
        return $this->id;
    }

    function getTitle() {
        return $this->title;
    }

    function getDueDate() {
        return $this->dueDate;
    }

    function getDescription() {
        return $this->description;
    }

    function getDone() {
        return $this->done;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setTitle($title) {
        $this->title = $title;
    }

    function setDueDate($dueDate) {
        $this->dueDate = $dueDate;
    }

    function setDescription($description) {
        $this->description = $description;
    }

    function setDone($done) {
        $this->done = $done;
    }
    function getUserId() {
        return $this->userId;
    }

    function setUserId($userId) {
        $this->userId = $userId;
    }





    
}

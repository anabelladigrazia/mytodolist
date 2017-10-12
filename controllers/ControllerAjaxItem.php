<?php
require_once ROOT_PATH . 'services/ServiceItem.php';
require_once ROOT_PATH . 'model/Item.php';
require_once ROOT_PATH . 'services/ServiceUser.php';
require_once ROOT_PATH . 'model/User.php';
class ControllerAjaxItem {
    protected $serviceItem; 
    protected $serviceUser;
    
    public function __construct() {
        $this->serviceItem = new ServiceItem();
        $this->serviceUser = new ServiceUser();                     
    }
    public function item(){
       $id = filter_input(INPUT_POST,'id');       
       $item = $this->serviceItem->item($id);
       include ROOT_PATH . 'views/sections/modal-edit.php';
    }

    public function itemsUser(){
        $userId = filter_var($_SESSION['userId']);
        $user = $this->serviceUser->user($userId);
        $items = $this->serviceItem->itemsUser($userId);
        include ROOT_PATH . 'views/sections/list.php';
    }
    public function addForm(){      
       include ROOT_PATH . 'views/sections/modal-add.php';
    }
    public function add(){
        $itemData = filter_input_array(INPUT_POST);
        if($this->validateItem($itemData)){
            $itemData['userId'] = filter_var($_SESSION['userId']);
            $rta = $this->serviceItem->add($itemData);            
        }else{
            $rta= array("state" => false, "msj" => "Invalid data. Try again.");
        }        
        if($rta['state']){
            http_response_code(200);            
        }else{
            http_response_code(400);
        }
        echo json_encode($rta);
    }
    public function update(){
        $itemData = filter_input_array(INPUT_POST);
        if($this->validateItem($itemData)){
            $rta = $this->serviceItem->update($itemData['id'], $itemData);
        }else{
            $rta= array("state" => false, "msj" => "Invalid data. Try again.");
        }        
        if($rta['state']){
            http_response_code(200);            
        }else{
            http_response_code(400);
        }
        echo json_encode($rta);
    }
    public function updateDone(){
        $itemData = filter_input_array(INPUT_POST);
        $rta = $this->serviceItem->update($itemData['id'], $itemData);
        if($rta['state']){
            http_response_code(200);            
        }else{
            http_response_code(400);
        }
        echo json_encode($rta);
    }
    public function remove(){
        $id = filter_input(INPUT_POST, 'id');
        $rta = $this->serviceItem->remove($id);
        if($rta['state']){
            http_response_code(200);            
        }else{
            http_response_code(400);
        }
        echo json_encode($rta);
    }
    
    private function validateItem($itemData){
        $title= isset($itemData['title']) ? $itemData['title'] : null;
        $duedate= isset($itemData['duedate']) ? $itemData['duedate'] : null;
        $description= isset($itemData['description']) ? $itemData['description'] : null;
        return $this->isComplete($title) && $this->max_length($title, 50)
            && $this->date($duedate)
            && $this->max_length($description, 255);
    }
    private function isComplete($value){
        return !($value === '' || $value === NULL);
    }
    private function max_length($value, $max){
        //Si no se completo no se valida
        if(! $this->isComplete($value)){
            return TRUE;
        }
        if(is_string($value) || strval($value)){
            if(strlen($value) > $max){
                return FALSE;
            }
        }else{
            return FALSE;
        }
        return TRUE;
    }   
    private function min_length($value, $min){
        //Si no se completo no se valida
        if(! $this->isComplete($value)){
            return TRUE;
        }
        if(is_string($value) || strval($value)){
            if(strlen($value) < $min){
                return FALSE;
            }
        }else{
            return FALSE;
        }
        return TRUE;
    } 
    private function date($value){
        //Si no se completo no se valida
        if(! $this->isComplete($value)){
            return TRUE;
        }    
        $dato_array= explode('-', $value);
        return checkdate($dato_array[1], $dato_array[2], $dato_array[0]);
    }
}


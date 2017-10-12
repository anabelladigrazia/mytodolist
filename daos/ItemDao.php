<?php
require_once ROOT_PATH .'daos/GenericDao.php';

class ItemDao extends GenericDao{
    /**
     * @param int $id
     * @return Item
     */
    public function item($id){
        $query = $this->connection->prepare("SELECT * FROM item WHERE id = :id");
        $query->bindParam("id", $id);
        $query->execute();
        $rta = $query->fetchObject('Item');
        return $rta;
    }
    /**
     * @param int $userId
     * @return Item[]
     */
    public function itemsUser($userId){
        $objects = array();
        $query = $this->connection->prepare("SELECT * FROM item WHERE userId = :userId");      
        $query->bindParam("userId", $userId);
        $query->execute();
        while($rta = $query->fetchObject('Item')){
            array_push($objects, $rta);
        }
        return $objects;
    }
    
    /**
     * @param Item $item
     * @return boolean
     */
    public function add($item){
        try {
            $data = $this->objecToArray($item);        
            $query = $this->connection->prepare("INSERT INTO item (title, dueDate, description, done, userId) VALUES(:title, :duedate, :description, :done, :userId)");        
            unset($data['id']);
            return $query->execute($data);
            
        } catch (Exception $ex) {
            return FALSE;
        }        
    }
    /**
     * @param Item $item
     * @return boolean
     */
    public function update($item){        
        try {
            $data = $this->objecToArray($item);
            $query = $this->connection->prepare("UPDATE item SET title = :title, duedate = :duedate, description = :description, done = :done, userId = :userId WHERE id = :id");       
          
            return $query->execute($data);
        } catch (Exception $ex) {
            return FALSE;
        }
    }
    /**
     * @param Item $item
     * @return boolean
     */
    public function remove($item){       
        try {
            $query = $this->connection->prepare("DELETE FROM item WHERE id = :id");            
            return $query->execute(array("id"=>$item->getId()));
        } catch (Exception $ex) {
            return FALSE;
        }
    }
    /**
     * @param Item $item
     * @return array
     */
    private function objecToArray($item){
        
        $data['id'] = $item->getId();
        $data['title'] = $item->getTitle();
        $data['duedate'] = $item->getDueDate();
        $data['description'] = $item->getDescription();
        if(!$item->getDone()){
            $data['done'] = 0;
        }else{
            $data['done'] = $item->getDone();
        }        
        $data['userId'] = $item->getUserId();
        return $data;
              
    }
}

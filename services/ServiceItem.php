<?php
require_once ROOT_PATH . 'daos/ItemDao.php';
class ServiceItem {
    protected $itemDao;
    public static $codes= array(
        'a-0' => array('state' => TRUE, 'msj' => 'The new Item has been succesfully added'),
        'a-1' => array('state' => FALSE, 'msj' => 'New Item creation has failed'),
        
        'u-0' => array('state' => TRUE, 'msj' => 'The Item has been succesfully updated'),
        'u-1' => array('state' => FALSE, 'msj' => 'Item update has failed'),
        'u-2' => array('state' => FALSE, 'msj' => 'The item that you are trying to update does not exist'),      
        'u-3' => array('state' => FALSE, 'msj' => 'Unable to update this item.'),      
        
        'r-0' => array('state' => TRUE, 'msj' => 'This Item has been succesfully removed'),
        'r-1' => array('state' => FALSE, 'msj' => 'Remove Item has failed'),
        'r-2' => array('state' => FALSE, 'msj' => 'The item that your trying to remove does not exist'), 
        'r-3' => array('state' => FALSE, 'msj' => 'Unable to remove this item.') 
    );
    
    public function __construct() {
        $this->itemDao = new ItemDao();
    }
    public function item($id){
        return $this->itemDao->item($id);
    }
    public function itemsUser($userId){
        return $this->itemDao->itemsUser($userId);
    }
    public function add($itemData){
        $item = $this->constructorItem($itemData);
        if($this->itemDao->add($item)){
            return ServiceItem::$codes['a-0'];
        }else{
            return ServiceItem::$codes['a-1'];
        }
    }
    public function update($id, $itemData){
        $userId = filter_var($_SESSION['userId']);
        $item = $this->itemDao->item($id);        
        if($item){
            if($item->getUserId()!= $userId){
                return ServiceItem::$codes['u-3'];
            }
            $this->constructorItem($itemData, $item);
            if($this->itemDao->update($item)){
                return ServiceItem::$codes['u-0'];
            }else{
                return ServiceItem::$codes['u-1'];
            }
        }
        return ServiceItem::$codes['u-2'];
    }
    public function remove($id){
        $userId = filter_var($_SESSION['userId']);
        $item = $this->itemDao->item($id);        
        if($item){
            if($item->getUserId()!= $userId){
                return ServiceItem::$codes['r-3'];
            }
            if($this->itemDao->remove($item)){
                return ServiceItem::$codes['r-0'];
            }else{
                return ServiceItem::$codes['r-1'];
            }
        }
        return ServiceItem::$codes['r-2'];
                
    }
    public function constructorItem($itemData,$item=NULL){
        if(!$item){
            $item = new Item();
        }
        !isset($itemData['title']) ?: $item->setTitle($itemData['title']); 
        !isset($itemData['duedate']) ?: $item->setDueDate($itemData['duedate']); 
        !isset($itemData['description']) ?: $item->setDescription($itemData['description']); 
        !isset($itemData['done']) ?: $item->setDone($itemData['done']); 
        !isset($itemData['userId']) ?: $item->setUserId($itemData['userId']);
        return $item;
    }
}

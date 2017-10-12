<?php
require_once ROOT_PATH .'services/ServiceItem.php';
require_once ROOT_PATH .'model/Item.php';

require_once ROOT_PATH .'services/ServiceUser.php';
require_once ROOT_PATH .'model/User.php';
class ControllerPage {
    /**
     *
     * @var ServiceItem
     */
    protected $serviceItem;
    protected $serviceUser;
    function __construct() {
        $this->serviceItem = new ServiceItem();
        $this->serviceUser = new ServiceUser();
    }

    function myTodoList(){
        $userId = filter_var($_SESSION['userId']);
        $user = $this->serviceUser->user($userId);
        $items = $this->serviceItem->itemsUser($userId);
        include ROOT_PATH .'views/pages/my-list.php';
    }
    function login(){
        include ROOT_PATH .'views/pages/login.php';
    }
}

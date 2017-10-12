<?php
require_once ROOT_PATH . 'daos/GenericDao.php';
require_once ROOT_PATH .'model/User.php';
class UserDao extends GenericDao{
    
    /**
     * @param int $id
     * @return User
     */
    public function user($id){
      $query = $this->connection->prepare("SELECT * FROM user WHERE id = :id");
      $query->bindParam("id", $id);
      $query->execute();
      $rta = $query->fetchObject('User');
      return $rta;
    }   
    /**
     * @param int $id
     * @return User
     */
    public function userLogin($username, $password){
      $query = $this->connection->prepare("SELECT * FROM user WHERE username = :username AND password = :password");
      $query->bindParam("username", $username);
      $query->bindParam("password", $password);
      $query->execute();
      $rta = $query->fetchObject('User');
      return $rta;
    }
   
}

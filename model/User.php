<?php
session_start();
include_once('Connection.php');

class User {
    private $id;
    private $username;
    private $fname;
    private $lname;
    private $email;
    private $password;

    private $connection;

    public function __construct() {
        $this->connection = new Connection();

        if (isset($_SESSION['userId'])) {
            $sql = "SELECT * FROM `user` WHERE `id` ='".$this->connection->escape($_SESSION['userId'])."'";
            $user = $this->connection->fetchAssoc($sql);
            
            $this->id = $user['id'];
            $this->username = $user['username'];
            $this->fname = $user['fname'];
            $this->lname = $user['lname'];
            $this->email = $user['email'];
            
        }
    }

    public function setUserName($username){
        $this->username = $username;
    }

    public function getUserName(){
        return $this->username;
    }

    public function setFName($fname){
        $this->fname = $fname;
    }

    public function getFName(){
        return $this->fname;
    }

    public function setLName($lname){
        $this->lname = $lname;
    }

    public function getLName(){
        return $this->lname;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function getEmail(){
        return $this->email;

    }

    public function setPassword($password){
        $this->password = md5($password);
    }

    public function getId(){
        return $this->id;
    }

    public function getUserByEmail($email) {

        $sql = "SELECT * FROM `user` WHERE `email` = '".$this->connection->escape($email)."'" ;

        return $this->connection->numRow($sql);
    }

    public function getUserByUsername($username) {
        $sql = "SELECT * FROM `user` WHERE `username` = '".$this->connection->escape($username)."'" ;
       
        return $this->connection->numRow($sql);
        
    }

    public function loginUser($email, $password) {
        $sql = "SELECT * FROM `user` WHERE (`email` = '".$this->connection->escape($email)."' OR `username` = '".$this->connection->escape($email)."') AND `password` = '".$this->connection->escape($password)."' ";

        $user = $this->connection->fetchAssoc($sql);
        if ($user) {
            
            $_SESSION['userId'] = $user['id'];
        }
        
        return $this->connection->numRow($sql);
    }

    public function save() {
        $sql = "INSERT INTO `user` SET `username` = '" . $this->connection->escape($this->username) . "',
        `fname` = '" . $this->connection->escape($this->fname) . "',`lname` = '" . $this->connection->escape($this->lname) . "',`email` = '" . $this->connection->escape($this->email) . "',`password` = '" . $this->connection->escape($this->password) . "'";

        $this->connection->query($sql);
    }
}

?>
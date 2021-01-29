<?php
session_start();
include_once('Connection.php');
include_once('User.php');

class Employee {
    private $employeeId;
    
    private $fname;
    private $lname;
    private $email;
    private $department;
    private $dob;
    private $connection;

    public function __construct() {
        $this->connection = new Connection();
    }


    public function setEmployeeId($employeeId){
        $this->employeeId = $employeeId;
    }

    public function getEmployeeId(){
        return $this->employeeId ;
    }

    public function setFName($fname){
        $this->fname = $fname;
    }

    public function getFName(){
        return $this->fname ;
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

    public function setDepartment($department){
        $this->department = $department;
    }

    public function getDepartment(){
        return $this->department;
    }

    public function setDob($dob){
        $this->dob = $dob;
    }

    public function getDob(){
        return $this->dob;
    }
    
    public function employeeAdd() {
        $userId = $_SESSION['userId'];
        $sql = "INSERT INTO `employee` SET `employee_id` = '".$this->connection->escape($this->employeeId)."', `user_id` = '".$this->connection->escape($userId)."', `fname` = '".$this->connection->escape($this->fname)."', `lname` =  '".$this->connection->escape($this->lname)."', `email` = '".$this->connection->escape($this->email)."', `department` = '".$this->connection->escape($this->department)."', `dob` = '".$this->connection->escape($this->dob)."'";

        $this->connection->query($sql);


    }

    public function employeeUpdate($employeeId){
        $userId = $_SESSION['userId'];

        $sql = "UPDATE `employee` SET `employee_id` = '".$this->connection->escape($this->employeeId)."', `user_id` = '".$this->connection->escape($userId)."', `fname` = '".$this->connection->escape($this->fname)."', `lname` =  '".$this->connection->escape($this->lname)."', `email` = '".$this->connection->escape($this->email)."', `department` = '".$this->connection->escape($this->department)."', `dob` = '".$this->connection->escape($this->dob)."' WHERE `employee_id` = '".$this->connection->escape($employeeId)."'";

        $this->connection->query($sql);


    }

    public function getEmployees() {
        $userId = $_SESSION['userId'];

        $sql = "SELECT * FROM `employee` WHERE `user_id` = '".$this->connection->escape($userId)."'";
        
       return $this->connection->fetchAssocs($sql);
    }


    public function employeeDelete($id){
        $sql = "DELETE FROM `employee` WHERE `id` = '".$this->connection->escape($id)."'";

        $this->connection->query($sql);


    }

}

?>
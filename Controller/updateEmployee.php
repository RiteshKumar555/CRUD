<?php
include_once('../model/Employee.php');

if (isset($_POST['addEmployeeID'])) { 
      
            
    $employee = new Employee();
    

    $employee->setEmployeeId($_POST['addEmployeeID']);
    $employee->setFName($_POST['addFName']);
    $employee->setLName($_POST['addLName']);
    $employee->setEmail($_POST['addEmail']);
    $employee->setDepartment($_POST['addDepartment']);
    $employee->setDob($_POST['dob']);
    
    $employee->employeeUpdate($_POST['addEmployeeID']);
    echo 'success';   

}


?>
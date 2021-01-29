<?php
include_once('../model/Employee.php');

if (isset($_POST['id'])) {             
    $employee = new Employee();

    $employee->employeeDelete($_POST['id']);
    
    echo 'success';

}

?>
<?php
include_once('../model/Employee.php');


$employee = new Employee();

$result = $employee->getEmployees();
echo json_encode($result);
?>
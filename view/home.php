<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
include_once('../model/User.php');

$user = new User();

$username = $user->getUserName();
            
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home Page</title>
    <link rel="stylesheet" href="http://localhost/CRUD/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <link rel="stylesheet" href="http://localhost/CRUD/css/style.css">
    <script src="http://localhost/CRUD/js/jquery.min.js"></script>
    <script src="http://localhost/CRUD/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <style>
        .input-group-append.btn.btn-outline-secondary.border-left-0 {
            height: 38px;
            margin-top: -20px;
            margin-right: -20px;
        } 
    </style>

</head>
<body>
    <div class="container-fluid">
        <div class="jumbotron text-center">
           <span>
                <?php
                echo $username;
                ?>
            <a href="http://localhost/CRUD/Controller/logout.php" ><button>Logout</button></span></a>
            <h1>Welcome</h1>
            
        </div>
        <div class="text-center">
            
            <button class="btn btn-primary btn-sm btn-rounded" data-toggle="modal" data-target="#myModal">ADD <i class="fa fa-plus ml-2" ></i></button>
            
            
           <button class="btn btn-danger btn-sm btn-rounded buttonDelete" id="multiple" >Delete<i class="fa fa-times ml-2"></i></button>
        </div>
          
        <div class="table-responsive">
            <table class="table text-center ">
                <thead>
                    <tr>
                        <td><input type="checkbox" id="check_all" onchange="$('.checkbox').prop('checked', this.checked);" value=""/></td>
                        <td>Employee ID</td>
                        <td>First Name</td>
                        <td>Last Name</td>
                        <td>Email</td>
                        <td>Department</td>
                        <td>Date of Birth</td>
                        <td>Action</td>
                                             
                    </tr>
                </thead>
                <tbody id="employee-list">


                </tbody>
            </table>
        </div>
  </div>
    <script>
        $(document).ready(function(){
            Employee.print();
            
        });

        var Employee = {
            print: function() {
                $.ajax({
                    type: "POST",
                    url : "http://localhost/CRUD/Controller/employeeDetail.php",
                    dataType : "json",
                    success: function(response){
                        var list = response;
                        var html = '';
                        for(var i in list) {
                            html += '<tr>';
                            html += ' <td><input type="checkbox" class="checkbox" value="'  + list[i]['id'] + '"></td>';
                            html += ' <td class="employee" >'  + list[i]['employee_id'] + '</td>';
                            html += ' <td>'  + list[i]['fname'] + '</td>';
                            html += ' <td>'  + list[i]['lname'] + '</td>';
                            html += ' <td>'  + list[i]['email'] + '</td>';
                            html += ' <td>'  + list[i]['department'] + '</td>';
                            html += ' <td>'  + list[i]['dob'] + '</td>';
                            html += ' <td><button type="button" class="btn btn-info" onclick="Employee.edit(this, '  + list[i]['id'] + ')"><i class="fa fa-pencil"></i>Edit</button> ';
                            html +='<button type="button" class="btn btn-danger" onclick="confirm(\'Are you sure?\') ? Employee.delete('  + list[i]['id'] + ') : false">Delete <i class="fa fa-times"></i></button></td>';
                            html += '</tr>';
                        }
                        $('#employee-list').html(html);
                    },
                    error: function(){
                            alert("Error");
                    }
                });
            },
            edit: function(thisthis, id) {
                var employee_id = $(thisthis).parent().parent().children('td:nth-child(2)').text();
                var fname = $(thisthis).parent().parent().children('td:nth-child(3)').text();
                var lname = $(thisthis).parent().parent().children('td:nth-child(4)').text();
                var email = $(thisthis).parent().parent().children('td:nth-child(5)').text();
                var department = $(thisthis).parent().parent().children('td:nth-child(6)').text();
                var dob = $(thisthis).parent().parent().children('td:nth-child(7)').text();

                $('#emplyee-form input[type="hidden"]').val(id);
                $('#input-employee-id').val(employee_id);
                $('#input-fname').val(fname);
                $('#input-lname').val(lname);
                $('#input-email').val(email);
                $('#input-department').val(department);
                $('#input-dob').val(dob);
                $('#myModal').modal('show');

                url = "http://localhost/CRUD/Controller/updateEmployee.php";
            },
            delete: function(id) {
                $.ajax({
                    type: "POST",
                    url: "http://localhost/CRUD/Controller/deleteEmployee.php",
                    data: {
                        id: id
                    },
                    success: function(response){
                        if (response == 'success') {
                            Employee.print();
                        }                        
                    },
                    error: function(){
                        alert("Error");
                    }
                });
            }

        }
        
        
        var url = "http://localhost/CRUD/Controller/addEmployee.php";

        $(document).on('click', "#submit", function() {
            $.ajax({
                type: "POST",
                url: url,
                data: $('#employee-form').serialize(),
                success: function(response){
                    if (response == 'success') {
                        $("#myModal").modal("hide");
                        $('#input-employee-id').val("");
                        $('#input-fname').val("");
                        $('#input-lname').val("");
                        $('#input-email').val("");
                        $('#input-department').val("");
                        $('#input-dob').val("");
                        Employee.print();
                    }
                },
                error: function(){
                    alert("Error");
                }
            });
        });

        // $('#check_all').click(function(){
        //     if($(this).prop("checked") == true){
        //         alert("Checkbox is checked.");
        //     }
        //     else if($(this).prop("checked") == false){
        //         alert("Checkbox is unchecked.");
        //     }
        // });

        // $('#check_all').click(function() {   
        //     if(this.checked) {
                
        //         $(':checkbox').each(function() {
        //             this.checked = true;                        
        //         });
        //     } else {
        //         $(':checkbox').each(function() {
        //             this.checked = false;                       
        //         });
        //     }
        // });

        $("#multiple").click(function() {
            if ($('.checkbox:checked').length < 1) {
                alert('Please select at least one');
                return false;
            } else if (confirm('Are you Sure')) {
                $('.checkbox:checked').each(function() {
                    var id = $(this).val();
                    Employee.delete(id);                    
                }); 
            }
            

        });
    </script>
    

    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Employee</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form name="addEmployee" id="employee-form" method="POST">
                        <input type="hidden" name="id" value="">
                        <div class="form-group">
                            <label for="input-employee-id">Employee ID</label>
                            <input type="text" class="form-control" id="input-employee-id" placeholder="Enter Employee ID" name="addEmployeeID" autocomplete="off" required>

                            <label for="input-fname">First Name</label>
                            <input type="text" class="form-control" id="input-fname" placeholder="Enter First Name" name="addFName" autocomplete="off" required>

                            <label for="input-lname">Last Name</label>
                            <input type="text" class="form-control" id="input-lname" placeholder="Enter Last Name" name="addLName" autocomplete="off" required>

                            <label for="input-email">Email</label>
                            <input type="email" class="form-control" id="input-email" placeholder="Enter Email" name="addEmail" autocomplete="off" required>

                            <label for="input-department">Department</label>
                            <input type="text" class="form-control" id="input-department" placeholder="Enter Department" name="addDepartment" autocomplete="off" required>

                            <label for="input-dob">DOB</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="input-dob" placeholder="Date of Birth" autocomplete="off"  name="dob">
                            </div>

                            <script>
                               $('#input-dob').datepicker({
                                   uiLibrary: 'bootstrap4',
                                   format: 'yyyy-mm-dd'
                                });
                            </script>
                            <button type="button" class="btn btn-primary mt-3" id="submit">Save</button>
                                                
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
  
</body>
</html>
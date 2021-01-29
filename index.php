<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MVC Concept</title>
    <link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>
        <?php   
         if(isset($_SESSION['userId'])){
            header('location: view/home.php');
           
        }       
        
        error_reporting(1);
        
        $username = $fname = $lname = $email = $password = '';
        $resisterMessage = '';

        if ($_GET['rmessage']) {
            $registerMessage = $_GET['rmessage'];
        }

        if($_GET['message']){
            $message = $_GET['message'];
        }
        
        
        
        if (isset($_SESSION['username'])) {
            $username = $_SESSION['username'];
            unset($_SESSION['username']);
        }

        if (isset($_SESSION['lname'])) {
            $lname = $_SESSION['lname'];
            unset($_SESSION['lname']);
        }

        if (isset($_SESSION['fname'])) {
            $fname = $_SESSION['fname'];
            unset($_SESSION['fname']);
        }

        if (isset($_SESSION['email'])) {
            $email = $_SESSION['email'];
            unset($_SESSION['email']);
        }

        if (isset($_SESSION['password'])) {
            $password = $_SESSION['password'];
            unset($_SESSION['password']);
        }
        ?>

    <div class="container-fluid">
        <div class="jumbotron text-center">
            <h1>Welcome</h1>
        </div>

        <div class="col-sm-6 float-left">
            <h1 class="text-center">Login</h1>
            <?php if ($message) { ?>
                <h4 style="color: red;"><?php echo $message; ?></h4>
            <?php } ?>
            <div class="form-horizontal">
                <form name="login" action="Controller/login.php" method="POST">
                    <div class="form-group">
                        <label for="input-username">Username or Email</label>
                        <input type="text" class="form-control" id="input-email" placeholder="Enter Email or Username" name="login-email" autocomplete="off"  required>

                        <label for="input-password">Password</label>
                        <input type="password" class="form-control" id="input-password" placeholder="Enter Password" name="login-password" autocomplete="off" required>

                        <input class="btn btn-primary mt-3" type="submit" value="Login" name="login">                      
                    </div>
                </form>
            </div>
        </div>

        <div class="col-sm-6 float-right">
            <h1 class="text-center">Registration</h1>
            <?php if ($registerMessage) { ?>
                <h4 style="color: red;"><?php echo $registerMessage; ?></h4>
            <?php } ?>
            <div class="form-horizontal">
               <form name="register" action="Controller/register.php" method="POST">
                   <div class="form-group">
                       <label for="input-fname">First Name</label>
                       <input type="text" class="form-control" id="input-fname"   placeholder="Enter first name" name="fname" autocomplete="off" required value="<?php echo $fname; ?>"> 
                       <label for="input-lname">Last Name</label>
                       <input type="text" class="form-control" id="input-lname" placeholder="Enter Last Name" name="lname" autocomplete="off" required value="<?php echo $lname; ?>">  
                       <label for="input-username">User Name</label>
                       <input type="text" class="form-control" id="input-username" placeholder="Enter User Name" name="username" autocomplete="off" required value="<?php echo $username; ?>">                      
                       <label for="input-email">Email Address</label>
                      <input type="email" class="form-control" id="email" placeholder="Enter Email   Address"  name="email" autocomplete="off" required value="<?php echo $email; ?>">
                      <label for="input-password">Password</label>
                       <input type="password" class="form-control" id="password" placeholder="Enter Password" name="password" autocomplete="off" required value="<?php echo $password; ?>">
                       <input class="btn btn-primary mt-3" type="submit" value="Signup" name="submit"> 
                  </div>
                </form>                  
            </div>          
        </div>
    </div>
    
</body>
</html>

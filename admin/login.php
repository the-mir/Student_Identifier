<?php

require_once 'connect.php';
session_start();

if(isset($_SESSION['user_login'])){
  header('location: index.php');
}

if(isset($_POST['login'])){
  $username = $_POST['username'];
  $password = $_POST['password'];

  $username_check = mysqli_query($connect,"SELECT * FROM `users` WHERE `username` = '$username'"); 
  if(mysqli_num_rows($username_check)>0){
   
    $row = mysqli_fetch_assoc($username_check);

    if($row['password'] == md5($password)){

      if($row['status'] == 'active'){
        $_SESSION['user_login'] = $username;
          header('location: index.php');
      }else{
        $status_inactive = "Your status inactive!";
      }

      
    } 
    else{
      $wrong_password = "Password wrong!";
    }

  }
   else{
    $username_not_found = "Username not found!";

  
   }
}

?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Students Management System</title>

    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">



  </head>
  <body style="background-color: cadetblue;">
  <div class="container ">
    <br><br>
    <div>   
      <center><img style="width: 400px;" src="../images/uv.jpeg" alt=""></center>
    </div>
        <!-- <h1 class="text-center">Students Management System</h1> -->
        <br>
        <?php if(isset($username_not_found)){ echo '<div class="alert alert-danger col-sm-4 col-sm-offset-4">'.$username_not_found.'</div>';}?>
        <?php if(isset($wrong_password)){ echo '<div class="alert alert-danger col-sm-4 col-sm-offset-4">'.$wrong_password.'</div>';}?>
        <?php if(isset($status_inactive)){ echo '<div class="alert alert-danger col-sm-4 col-sm-offset-4">'.$status_inactive.'</div>';}?>
      
   <div class="row">

   <div class="col-sm-4 col-sm-offset-4">
       <div><h3 class="text-center">Admin Login</h3></div>
       <form action="login.php" method="POST">
           <div>
               <input type="text" placeholder="Enter Username" name="username" required="" class="form-control" value="<?php if(isset($username)){ echo $username;} ?>">

           </div>

           <div>
               <input type="password" placeholder="Enter password" name="password" required="" class="form-control" value="<?php if(isset($password)){ echo $password;} ?>">

           </div>
           <br>
           <div>
           
           <center>
           <a class="btn btn-primary" href="../index.php">Back</a>
          <input  type="submit" value="Login" name="login" class="btn btn-info"> 
          </center>


           </div>


       </form>

   </div>


   </div>

  </div>

   
  </body>
</html>
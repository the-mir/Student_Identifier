<?php


require_once 'connect.php';
session_start();
if(isset($_POST['registration'])){
    
$name = $_POST['name'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];
$c_password = $_POST['c_password'];


$photo = explode('.',$_FILES['photo']['name']);
$photo = end($photo);
$photo_name = $username.'.'.$photo;

$input_error = array();

if(empty($name)){

    $input_error['name'] = "Name field is empty!";

}
if(empty($email)){

    $input_error['email'] = "Email field is empty!";

}
if(empty($username)){

    $input_error['username'] = "Username field is empty!";

}
if(empty($password)){

    $input_error['password'] = "Password field is empty!";

}
if(empty($c_password)){

    $input_error['c_password'] = "Conform password Field is empty!";

}
if(count($input_error) == 0){

    $email_check = mysqli_query($connect,"SELECT * FROM `users` WHERE `email` = '$email';");
      if(mysqli_num_rows($email_check) == 0){
          if(strlen($password)>7){
            if($password == $c_password){
                $password = md5($password);
                $query = "INSERT INTO `users`(`name`, `email`, `username`, `password`, `photo`, `status`) VALUES ('$name','$email','$username','$password','$photo_name','inactive')";
                $result = mysqli_query($connect,$query);

                if($result){

                    $_SESSION['data_insert_success'] ="Data insert success!";
                    move_uploaded_file($_FILES['photo']['tmp_name'],'images/'.$photo_name);
                    header('location: registration.php');
                }
                else{

                    $_SESSION['data_insert_error'] ="Data insert failed!";


                }


            }else{
                $password_not_match = "Conform password not match!";
            }

          }else{
              $password_l = "Password more then 8 characters!";
          }
      } else{

        $email_error = "Email Address Already Exists!";
      }
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
    <link rel="stylesheet" href="style.css">


  </head>
  <body>
  <div class="container ">  
        <h1 class="text-center">User Registration</h1>
        <?php  
        
        if(isset($_SESSION['data_insert_success'])){
            echo '<div class="alert alert-success">'.$_SESSION['data_insert_success'].'</div>';
        }
        
        ?>
        <?php  
        
        if(isset($_SESSION['data_insert_error'])){
            echo '<div class="alert alert-warning">'.$_SESSION['data_insert_error'].'</div>';
        }
        
        ?>
        
        <hr>
        <div class="row">
            <div class="col-md-12">
                <form action="" method="POST" enctype="multipart/form-data" class="form-horizontal">
                <div class="form-group">
                    <label for="name" class="control-label col-sm-1">Name</label>
                   <div class="col-sm-4">
                   <input class="form-control" id="name" type="text" name="name" placeholder="Enter your name." value="<?php if(isset($name)) { echo $name;} ?>">
                   </div>
                   <label class="error">

                    <?php  
                       
                       if(isset($input_error['name'])){
                           echo $input_error['name'];
                       }
                   
                    ?>
                   
                </label>
                </div>
                <div class="form-group">
                    <label for="email" class="control-label col-sm-1">Email</label>
                   <div class="col-sm-4">
                   <input class="form-control" id="email" type="email" name="email" placeholder="Enter your email."value="<?php if(isset($email)) { echo $email;} ?>">
                   </div>
                   <label class="error">

                    <?php  
                       
                       if(isset($input_error['email'])){
                           echo $input_error['email'];
                       }
                   
                    ?>
                   </label>

                   <label class="error"><?php if(isset($email_error)){ echo $email_error;} ?></label>

                </div>
                <div class="form-group">
                    <label for="username" class="control-label col-sm-1">Username</label>
                   <div class="col-sm-4">
                   <input class="form-control" id="username" type="text" name="username" placeholder="Enter your username." value="<?php if(isset($username)) { echo $username;} ?>">
                   </div>
                   <label class="error">

                    <?php  
                       
                       if(isset($input_error['username'])){
                           echo $input_error['username'];
                       }
                   
                    ?>
                   </label>
                </div>
                <div class="form-group">
                    <label for="password" class="control-label col-sm-1">Password</label>
                   <div class="col-sm-4">
                   <input class="form-control" id="password" type="password" name="password" placeholder="Enter your password." value="<?php if(isset($password)) { echo $password;} ?>">
                   </div>
                   <label class="error">

                    <?php  
                       
                       if(isset($input_error['password'])){
                           echo $input_error['password'];
                       }
                   
                    ?> 
                   </label>
                   <label class="error">

                    <?php  
                       
                       if(isset($password_l)){
                           echo $password_l;
                       }
                   
                    ?> 
                   </label>
                </div>
                <div class="form-group">
                    <label for="c_password" class="control-label col-sm-1">Conform Password</label>
                   <div class="col-sm-4">
                   <input class="form-control" id="c_password" type="password" name="c_password" placeholder="Enter your conform password." value="<?php if(isset($c_password)) { echo $c_password;} ?>">
                   </div>
                   <label class="error">

                    <?php  
                       
                       if(isset($input_error['c_password'])){
                           echo $input_error['c_password'];
                       }
                   
                    ?>
                   </label>
                   <label class="error">

                    <?php  
                       
                       if(isset($password_not_match)){
                           echo $password_not_match;
                       }
                   
                    ?>
                   </label>
                </div>
                <div class="form-group">
                    <label for="photo" class="control-label col-sm-1">Photo</label>
                   <div class="col-sm-4">
                   <input  id="photo" type="file" name="photo">
                   </div>
                </div>
                <div class="col-sm-4 col-sm-offset-1">
                    <input class="btn btn-primary" type="submit" value="Registration" name="registration">
                </div>
            
            </form>
            </div>
        </div>
        <br>
        <p>If you have an account? then please <a href="login.php">Login</a> </p>
        <hr>
        <footer >
        <center> <p>Copyright &copy; <a href="https://www.facebook.com/0xmir">Mir Md. Mosarof Hossan Showrav</a> 2021</p></center>
        </footer>
   </div>

  </body>
</html>
<h1 class="text-primary"><i class="fa fa-user"></i> User Profile <small>My Profile</small> </h1>
<ol class="breadcrumb">
    <li><a href="index.php?page=dashboard"> <i class="fa fa-dashboard"></i> Dashboard </a></li>
    <li class="active"><i class="fa fa-user"></i> Profile</li>
</ol>

<?php

$session_user = $_SESSION['user_login'];

$user_data = mysqli_query($connect, "SELECT * FROM `users` WHERE `username` = '$session_user'");

$user_row = mysqli_fetch_assoc($user_data);

?>

<div class="row">

    <div class="col-sm-6">
        <table class="table table-bordered">

            <tr>
                <td>User ID</td>
                <td> <?= $user_row['id']; ?> </td>
            </tr>
            <tr>
                <td>Name</td>
                <td><?= ucwords($user_row['name']); ?> </td>
            </tr>
            <tr>
                <td>Username</td>
                <td><?= $user_row['username']; ?></td>
            </tr>
            <tr>
                <td> Email </td>
                <td><?= $user_row['email']; ?></td>
            </tr>
            <tr>
                <td>Status</td>
                <td><?= ucwords($user_row['status']); ?></td>
            </tr>
            <tr>
                <td>Signup Date</td>
                <td><?= $user_row['datetime']; ?></td>
            </tr>


        </table>

        <a href="" class="btn btn-sm btn-info pull-right">Edit Profile</a>

    </div>
    <div class="col-sm-6">
        <a href="">
            <img style="width: 300px;" src="images/showrav.jpg" alt="">
        </a>

        <?php

        if (isset($_POST['upload'])) {
            $photo = explode('.', $_FILES['photo']['name']);
            $photo = end($photo);
            $photo_name = $session_user . '.' . $photo;

          $upload =  mysqli_query($connect,"UPDATE `users` SET `photo`='$photo_name'WHERE  `username` ='$session_user'");
          if($upload){
              move_uploaded_file($_FILES['photo']['tmp_name'],'images/'.$photo_name );
          }
        }

        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <label for="photo">Profile Picture</label>
            <input type="file" name="photo" required="" id="photo">
            <br>
            <center><input class="btn btn-sm btn-info" type="submit" name="upload" value="Upload"></center>

        </form>

    </div>

</div>
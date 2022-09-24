<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Students Management System</title>

  <!-- Bootstrap -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  


</head>

<body style="background-color: cadetblue;">
  


  </style>

  <br />

  <div class="container">
    <a class="btn btn-primary pull-right" href="admin/login.php">Login</a>
    <br />
    <div>
     <center> <img style="width: 500px;" src="./images/UITS-Short-01.png" alt=""></center>
    </div>
    <!-- <h1 class="text-center">University of Information Technology and Sciences</h1> -->
    <br />
    <div class="row">

      <div class="col-sm-4 col-sm-offset-4">
        <form action="" method="POST">
          <table class="table table-bordered">

            <tr>
              <td colspan="2" class="text-center"><label>Student Information</label></td>
            </tr>

            <tr>
              <td><label for="choose">Department</label></td>

              <td>
                <select class="form-control" id="choose" name="choose">

                  <option value="">Select</option>
                  <option value="CSE">CSE</option>
                  <option value="IT">IT</option>
                  <option value="EEE">EEE</option>

                </select>

              </td>
            </tr>

            <tr>
              <td><label for="roll">ID</label></td>

              <td><input class="form-control" type="text" name="roll" placeholder=" Enter your id" /></td>
            </tr>
            <tr>

              <td class="text-center" colspan="2"> <input class="btn btn-default" type="submit" value="Show Information" name="show_info" </td>

            </tr>

          </table>
        </form>
      </div>

    </div>
    <br><br>

    <?php
    require_once './admin/connect.php';
    if (isset($_POST['show_info'])) {

      $choose = $_POST['choose'];
      $roll = $_POST['roll'];

      $result = mysqli_query($connect, "SELECT * FROM `student_info` WHERE `department`= '$choose' AND `roll`= ' $roll'");

      if (mysqli_num_rows($result)==1) {

         $row = mysqli_fetch_assoc($result);
    ?>
        <div class="row">
          <div class="col-sm-6 col-sm-offset-3">
            <table class="table table-bordered">
              <tr>
                <td rowspan="5">
                  <img class="img-thumbnail" style="width:200px;" src="admin/student_images/<?= $row['photo'] ?>" alt="">
                </td>
                <td>Name</td>
                <td><?= $row['name'] ?></td>
              </tr>
              <tr>

                <td>Roll</td>
                <td><?= $row['roll'] ?></td>
              </tr>
              <tr>

                <td>Department</td>
                <td><?= $row['department'] ?></td>
              </tr>
              <tr>

                <td>City</td>
                <td><?= $row['city'] ?></td>
              </tr>


            </table>

          </div>


        </div>



      <?php

        } else {


        ?>
     <script type="text/javascript">

       alert('Data not fount!');


     </script>
  <?php

      }

    }
    ?>


  </div>



  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

  <script src="js/bootstrap.min.js"></script>
</body>

</html>
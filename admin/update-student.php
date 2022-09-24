<h1 class="text-primary"><i class="fa fa-pencil-square-o"></i> Update Student <small>Update student</small> </h1>
<ol class="breadcrumb">
    <li><a href="index.php?page=dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li><a href="index.php?page=all-students"><i class="fa fa-users"></i> All Students</a></li>
    <li class="active"><i class="fa fa-pencil-square-o"></i> Update Student</li>
</ol>

<?php

$id = base64_decode($_GET['id']);



$std_data = mysqli_query($connect,"SELECT * FROM `student_info` WHERE `id`='$id'");


$std_row = mysqli_fetch_assoc($std_data);


if(isset($_POST['update-student'])){
    $name = $_POST['name'];
    $city = $_POST['city'];
    $pcontact = $_POST['pcontact'];
    $department = $_POST['department'];
    $roll = $_POST['roll'];


    $query = "UPDATE `student_info` SET `name`='$name',`roll`='$roll',`department`='$department',`city`='$city',`pcontact`='$pcontact' WHERE `id`='$id'";
    $result = mysqli_query($connect,$query);
    if($result){
        header("location: index.php?page=all-students");
    }


    } 
  
?>

<div class="row">
    <div class="col-sm-6">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Student Name</label>
                <input type="text" name="name" placeholder="Enter student name" id="name" class="form-control" required="" value="<?= $std_row['name']?>">
            </div>
            <div class="form-group">
                <label for="name">Student City</label>
                <input type="text" name="city" placeholder="Enter student city" id="city" class="form-control" required="" value="<?= $std_row['city']?>">
            </div>
            <div class="form-group">
                <label for="name">Student Parents Contact</label>
                <input type="number" name="pcontact" placeholder="+8801*********" id="pcontact" class="form-control" required="" value="<?= $std_row['pcontact']?>">
            </div>
            <div class="form-group">
                <label for="department">Student Department</label>
                <select id="department" class="form-control" name="department" required="" >
                    <option value="">Select</option>
                    <option <?php echo $std_row['department']=='CSE' ? 'selected=""':'';?> value="CSE">CSE</option>
                    <option <?php echo $std_row['department']=='IT' ? 'selected=""':'';?> value="IT">IT</option>
                    <option <?php echo $std_row['department']=='EEE' ? 'selected=""':'';?> value="EEE">EEE</option>
                </select>

            </div>
            <div class="form-group">
                <label for="roll">Student Roll</label>
                <input type="number" name="roll" placeholder="Enter student roll" id="roll" class="form-control" required="" value="<?= $std_row['roll']?>">
            </div>

        
            <div class="form-group">
                <center><input type="submit" value="Update Student" name="update-student" class="btn btn-primary"></center>
            </div>


        </form>

    </div>
</div>
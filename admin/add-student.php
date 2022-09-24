<h1 class="text-primary"><i class="fa fa-user-plus"></i> Add Student <small>Add new student</small> </h1>
<ol class="breadcrumb">
    <li><a href="index.php?page=dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active"><i class="fa fa-user-plus"></i> Add Student</li>
</ol>

<?php
if(isset($_POST['add-student'])){
     $name = $_POST['name'];
     $city = $_POST['city'];
     $pcontact = $_POST['pcontact'];
     $department = $_POST['department'];
     $roll = $_POST['roll'];


     $picture = explode('.',$_FILES['picture']['name']);
     $picture_ex =end($picture);

     $picture_name = $roll.'.'.$picture_ex;


     $query = "INSERT INTO `student_info`(`name`, `roll`, `department`, `city`, `pcontact`, `photo`) VALUES ('$name','$roll','$department','$city','$pcontact','$picture_name')";
     $result = mysqli_query($connect,$query);


     if($result){
        $success ="Data insert success!";
      move_uploaded_file($_FILES['picture']['tmp_name'],'student_images/'.$picture_name);

     } 
     else{

        $error = "Data insert failed!";
     }



}



?>


<div class="row">
    <?php if(isset($success)){ echo '<p class="alert alert-success">'.$success.'</p>';} ?>
    <?php if(isset($error)){ echo '<p class="alert alert-danger">'.$error.'</p>';} ?>


</div>
<div class="row">
    <div class="col-sm-6">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Student Name</label>
                <input type="text" name="name" placeholder="Enter student name" id="name" class="form-control" required="">
            </div>
            <div class="form-group">
                <label for="name">Student City</label>
                <input type="text" name="city" placeholder="Enter student city" id="city" class="form-control" required="">
            </div>
            <div class="form-group">
                <label for="name">Student Parents Contact</label>
                <input type="number" name="pcontact" placeholder="+8801*********" id="pcontact" class="form-control" required="">
            </div>
            <div class="form-group">
                <label for="department">Student Department</label>
                <select id="department" class="form-control" name="department" required="">
                    <option value="">Select</option>
                    <option value="CSE">CSE</option>
                    <option value="IT">IT</option>
                    <option value="EEE">EEE</option>
                </select>

            </div>
            <div class="form-group">
                <label for="roll">Student Roll</label>
                <input type="number" name="roll" placeholder="Enter student roll" id="roll" class="form-control" required="">
            </div>

            <div class="form-group">
                <label for="picture">Student Picture</label>
                <input type="file" name="picture" id="picture" required="">
            </div>
            <div class="form-group">
                <center><input type="submit" value="Add Student" name="add-student" class="btn btn-primary"></center>
            </div>


        </form>

    </div>
</div>
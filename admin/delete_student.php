<?php 

require_once './connect.php';
$id = base64_decode($_GET['id']);

mysqli_query($connect,"DELETE FROM `student_info` WHERE `id`= '$id'");

header("location: index.php?page=all-students");


?>
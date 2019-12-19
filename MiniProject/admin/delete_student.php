<?php
    require_once './dbconnection.php';
    $id = base64_decode($_GET['id']);

    mysqli_query($link,"DELETE FROM `student_information` WHERE `id`= '$id'");
    header("location: index.php?page=all-students");
?>
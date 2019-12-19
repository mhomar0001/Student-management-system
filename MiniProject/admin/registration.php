<?php

require_once './dbconnection.php'; //Connection is ok!!!done
session_start();

    if(isset($_POST['registration'])){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $c_password = $_POST['c_password'];

        $photo = explode('.',$_FILES['photo']['name']);
        $photo = end($photo); //To get Extension of the photo
        $photo_name=$username.'.'.$photo;
        //echo $photo_name;

        $input_error = array();

        if(empty($name)){
            $input_error['name']="The name field is required..!!!";
        }

        
        if(empty($email)){
            $input_error['email']="The email field is required..!!!";
        }

        
        if(empty($username)){
            $input_error['username']="The username field is required..!!!";
        }

        
        if(empty($password)){
            $input_error['password']="The password field is required..!!!";
        }

        
        if(empty($c_password)){
            $input_error['c_password']="The c_password field is required..!!!";
        }

        if(count($input_error) == 0)
        {
            $email_check = mysqli_query($link,"SELECT * FROM `users` WHERE `email` = '$email';");

           if(mysqli_num_rows($email_check)==0)
           {
                $username_check = mysqli_query($link,"SELECT * FROM `users` WHERE `user_name` = '$username';");
                if(mysqli_num_rows($username_check)==0)
                {
                    $username_error = "";
                    if(strlen($username) > 7)
                    {
                        if(strlen($password) > 7)
                        {
                            if($password == $c_password)
                            {
                                $password = md5($password);
                                $query = "INSERT INTO `users`(`name`, `email`, `user_name`, `password`, `photo`, `status`) VALUES ('$name','$email','$username','$password','$photo_name','inactive')";
                                $result = mysqli_query($link,$query);

                                if($result)
                                {
                                    $_SESSION['data_insert_success'] = "Data Insert Succeeded !!";
                                    move_uploaded_file($_FILES['photo']['tmp_name'],'images/'.$photo_name);
                                    header('location: registration.php');
                                }
                                else
                                {
                                    $_SESSION['data_insert_error'] = "Data Insert Error !!";
                                }
                            }
                            else
                            {
                                $password_not_match = "Confirm Password is not matched !!";
                            }
                        }
                        else
                        {
                            $password_len = "Password must be at least 8 characters !!";
                        }
                    }
                    else
                    {
                        $username_len = "Username must be more than 6 characters !!";
                    }
                }
                else
                {
                    $username_error = "This Username is already exist !!";
                }
           }
           else
           {
               $email_error = "This email address is already exist !!";
           }
        }
        //print_r($email_check);
        //print_r($input_error);
        /*echo '<pre>';
        print_r($_POST);
        echo '</pre>';*/
    }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Student Management System</title>

    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/animate.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <div class="container">
        <h1>User Registration Form</h1>
        <?php 
            if(isset($_SESSION['data_insert_success']))
            echo '<div class= "alert alert-success">'.$_SESSION['data_insert_success'].'</div>'; 
        ?>
        <?php 
            if(isset($_SESSION['data_insert_error']))
            echo '<div class= "alert alert-warning">'.$_SESSION['data_insert_error'].'</div>';
        ?>
        

        <hr/>
        <div class="row">
            <div class="col-md-12">
                <form action="" method="POST" enctype="multipart/form-data" class="form-horizontal">
                    <div class="form-group">
                        <label for="name" class="control-label col-sm-1">Name</label>
                            <div class="col-sm-4">
                               <input class="form-control" type="text"  id="name" name="name" placeholder="Enter your name" value="<?php if(isset($name)){echo $name;}?>"/>
                            </div>
                            <label class="error">
                                <?php
                                    if(isset($input_error['name']))
                                    echo $input_error['name'];
                                ?>
                            </label>
                    </div>

                    <div class="form-group">
                        <label for="email" class="control-label col-sm-1">Email</label>
                            <div class="col-sm-4">
                               <input class="form-control" type="text"  id="email" name="email" placeholder="Enter your email" value="<?php if(isset($email)){echo $email;}?>"/>
                            </div>
                            <label class="error">
                                <?php
                                    if(isset($input_error['email']))
                                    echo $input_error['email'];
                                ?>
                            </label>
                            <label class="error">
                                <?php
                                    if(isset($email_error))
                                    echo $email_error;
                                ?>
                            </label>
                    </div>

                    <div class="form-group">
                        <label for="username" class="control-label col-sm-1">Username</label>
                            <div class="col-sm-4">
                               <input class="form-control" type="text"  id="username" name="username" placeholder="Enter your username" value="<?php if(isset($username)){echo $username;}?>"/>
                            </div>
                            <label class="error">
                                <?php
                                    if(isset($input_error['username']))
                                    echo $input_error['username'];
                                ?>
                            </label>
                            <label class="error">
                                <?php
                                    if(isset($username_check))
                                    echo $username_error;
                                ?>
                            </label>
                            <label class="error">
                                <?php
                                    if(isset($username_len))
                                    echo $username_len;
                                ?>
                            </label>
                    </div>

                    <div class="form-group">
                        <label for="password" class="control-label col-sm-1">Password</label>
                            <div class="col-sm-4">
                               <input class="form-control" type="password"  id="password" name="password" placeholder="Enter your password" value="<?php if(isset($password)){echo $password;}?>"/>
                            </div>
                            <label class="error">
                                <?php
                                    if(isset($input_error['password']))
                                    echo $input_error['password'];
                                ?>
                            </label>
                            <label class="error">
                                <?php
                                    if(isset($password_len))
                                    echo $password_len;
                                ?>
                            </label>
                    </div>

                    
                    <div class="form-group">
                        <label for="c_password" class="control-label col-sm-1">Confirm Password</label>
                            <div class="col-sm-4">
                               <input class="form-control" type="password"  id="c_password" name="c_password" placeholder="Confirm your password" value="<?php if(isset($c_password)){echo $c_password;}?>"/>
                            </div>
                            <label class="error">
                                <?php
                                    if(isset($input_error['c_password']))
                                    echo $input_error['c_password'];
                                ?>
                            </label>
                            <label class="error">
                                <?php
                                    if(isset($password_not_match))
                                    echo $password_not_match;
                                ?>
                            </label>
                    </div>

                    <div class="form-group">
                        <label for="photo" class="control-label col-sm-1">Photo</label>
                            <div class="col-sm-4">
                               <input type="file"  id="photo" name="photo"/>
                            </div>
                    </div>

                    <div class="col-sm-4 col-sm-offset-1">
                        <input type="submit" value="Registration" name="registration" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
        <br/>
        <p>If you have an account then <a href="login.php">Login</a></p>
        <hr/>
        <footer>
            <p style="color: red">Copyright  &copy;<?php echo date('Y')?> All Rights Reserved</p>
        </footer>
    </div>
  </body>
</html>
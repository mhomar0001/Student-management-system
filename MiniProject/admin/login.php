<?php
    require_once './dbconnection.php';
    session_start();
    if(isset($_SESSION['user_login']))
    {
        header('location: index.php');
    }
    if(isset($_POST['login']))
    {
        $username = $_POST['username'];
        $password = $_POST['password'];


        $username_check = mysqli_query($link, "SELECT * FROM `users` WHERE `user_name`= '$username'");
        if(mysqli_num_rows($username_check) > 0)
        {
            $row = mysqli_fetch_assoc($username_check);

            if($row['password'] == md5($password))
            {
                if($row['status'] == 'active')
                {
                    $_SESSION['user_login'] = $username;
                    header('location: index.php');
                }
                else
                {
                    $status_inactive = "Your status is inactive";
                }
            }
            else
            {
                $wrong_password = "This Password Wrong !!";
            }
        }
        else
        {
            $username_not_found = "This username is not found !!";
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
    <title>Student Management System</title>

    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/animate.css" rel="stylesheet">
  </head>
  <body style="background: #f5f5f5">
    <div class="container animated shake">
    <br><h1 class="text-center">Student Management System</h1><br/>
        <div class="row">
            <div class="col-sm-4 col-sm-offset-4">
                <h2 class="text-center">Admin Login Form</h2><br/>
                <form action="login.php" method="POST">
                    <div>
                        <input type="text" placeholder="Username" name="username" required="" class="form-control" value = "<?php if(isset($username)) echo $username;?>">
                    </div>
                    <br/>
                    <div>
                        <input type="password" placeholder="Password" name="password" required="" class="form-control" value = "<?php if(isset($password)) echo $password;?>">
                    </div>
                        <br/>
                    <div>
                        <input type="submit" value="Login" name="login" class="btn btn-info pull-right">
                    </div>
                    <a href="../">Back</a>
                </form>
            </div>
        </div>
    </div>
    <br/>
    <?php
        if(isset($username_not_found))
        {
            echo '<div class="alert alert-danger col-sm-4 col-sm-offset-4">'.$username_not_found.'</div>';
        }
    ?>
    <?php
        if(isset($wrong_password))
        {
            echo '<div class="alert alert-danger col-sm-4 col-sm-offset-4">'.$wrong_password.'</div>';
        }
    ?>
    <?php
        if(isset($status_inactive))
        {
            echo '<div class="alert alert-danger col-sm-4 col-sm-offset-4">'.$status_inactive.'</div>';
        }
    ?>
  </body>
</html>
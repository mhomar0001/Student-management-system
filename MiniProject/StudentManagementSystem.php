<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Student Management System</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    
  </head>
  <body>
    <div class="container">
        <br>
        <a class = "btn btn-primary pull-right" href="admin/registration.php">For Registration</a>
        <a class = "btn btn-primary pull-middle" href="admin/login.php">Login</a>
        &nbsp;&nbsp;
       
        <br><br>
        <h1 class="text-center">Welcome to Student Management System !!</h1><br/>

       <div class="row">
            <div class="col-sm-4 col-sm-offset-4">
            <form action="" method="POST">
            <table class="table table-bordered">
                <tr>
                    <td colspan="2" class="text-center"><label>Student Information</label></td>
                </tr>

                <tr>
                    <td><label for="choose">Choose Class</label></td>
                    <td>
                        <select class="form-control" id="choose" name="choose">
                            <option value="">Select</option>
                            <option value="1st">1st</option>
                            <option value="2nd">2nd</option>
                            <option value="3rd">3rd</option>
                            <option value="4th">4th</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td><label for="roll">Roll</label></td>
                    <td><input class="form-control" id="roll" type="text" name="roll" pattern="[0-9]{6}" placeholder="Roll"></td>
                </tr>

                <tr>
                    <td class="text-center" colspan="2">
                        <input class="btn btn-default"type="submit" value="Show Info" name="show_info">
                    </td>
                </tr>
            </table>
        
            </form>
            </div>
        </div>
        <br><br>

        <?php
            require_once './admin/dbconnection.php';
            if(isset($_POST['show_info'])){
                $choose = $_POST['choose'];
                $roll = $_POST['roll'];


                $result = mysqli_query($link,"SELECT * FROM `student_information` WHERE `class` = '$choose' and `roll` = '$roll'");
                if(mysqli_num_rows($result )==1){
                    $row = mysqli_fetch_assoc($result);
                ?>
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3">
                        <table class="table table-bordered">
                            <tr>
                                <td rowspan="5">
                                <img src="admin/student_image/<?php echo $row['photo'];?>" class="img-thumbnail" style="width: 150px" alt="">
                                </td>
                                <td>Name</td>
                                <td><?php echo $row['name'];?></td>
                            </tr>
                            <tr>
                                <td>Roll</td>
                                <td><?php echo $row['roll'];?></td>
                            </tr>
                            <tr>
                                <td>Class</td>
                                <td><?php echo $row['class'];?></td>
                            </tr>
                            <tr>
                                <td>City</td>
                                <td><?php echo $row['city'];?></td>
                            </tr>
                            <tr>
                                <td>Contact</td>
                                <td><?php echo $row['contact'];?></td>
                            </tr>
                            
                        </table>
                    </div>
                </div>
                <?php
                }else{
                ?>
                    <script class="text/javascript">
                        alert("Data Not Found");
                    </script>
                <?php }}?>
        
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
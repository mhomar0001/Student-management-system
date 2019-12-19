<h1 class="text-primary"><i class="fa fa-user"></i> User Profile <small>My Profile</small></h1>
    <ol class="breadcrumb">
        <li><a href="index.php?page=dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><i class="fa fa-user"></i> Profile</li>
    </ol>

<?php
    $session_user = $_SESSION['user_login'];
    $user_data = mysqli_query($link,"SELECT * FROM `users` WHERE `user_name`= '$session_user'");
    $user_row = mysqli_fetch_assoc($user_data);

?>
    <div class="row">
        <div class="col-sm-6">
            <table class="table table-bordered">
                <tr>
                    <td>User ID</td>
                    <td><?php echo $user_row['id'];?></td>
                </tr>
                <tr>
                    <td>Name</td>
                    <td><?php echo ucwords($user_row['name']);?></td>
                </tr>
                <tr>
                    <td>Username</td>
                    <td><?php echo $user_row['user_name'];?></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><?php echo $user_row['email'];?></td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td><?php echo ucwords($user_row['status']);?></td>
                </tr>
                <tr>
                    <td>Sign Up Date</td>
                    <td><?php echo $user_row['date_time'];?></td>
                </tr>
            </table>
            <a href="index.php?page=update-profile&id=<?php echo base64_encode($user_row['id']);?>" class="btn btn-sm btn-info pull-right">Edit Profile</a>
        </div>
        <div class="col-sm-6">
            <a href="">
                <img class = "img-thumbnail" src="images/<?php echo $user_row['photo'];?>" style="height:200px; width:180px" alt="">
            </a>
            <br><br>
            <?php 
                if(isset($_POST['upload'])){
                    $photo = explode('.',$_FILES['photo']['name']);
                    $photo = end($photo); //To get Extension of the photo
                    $photo_name = $session_user.'.'.$photo;

                    $upload = mysqli_query($link,"UPDATE `users` SET `photo`= '$photo_name' WHERE `user_name` = '$session_user'");
                    if($upload){
                        move_uploaded_file($_FILES['photo']['tmp_name'],'images/'.$photo_name);
                    }
                }
            ?>
            <form action="" enctype="multipart/form-data" method="POST">
                <label for="photo">Profile Picture</label>
                <input type="file" name="photo" required="" id="photo"><br>
                <input class="btn btn-sm btn-info " type="submit" name="upload" value="Upload">
            </form>
        </div>
    </div>
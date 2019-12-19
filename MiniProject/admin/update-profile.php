<h1 class="text-primary"><i class="fa fa-pencil-square-o"></i> Update Student <small>Update Student</small></h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php?page=dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                        <li><a href="index.php?page=all-students"><i class="fa fa-users"></i> All Students</a></li>
                        <li class="active"><i class="fa fa-pencil-square-o"></i> Update Student</li>
                    </ol>


<?php

    $id = base64_decode($_GET['id']);
    $db_data = mysqli_query($link,"SELECT * FROM `users` WHERE `id`= '$id'");
    $db_row = mysqli_fetch_assoc($db_data);

    if(isset($_POST['update-profile'])){
        $name = $_POST['name'];
        $username = $_POST['username'];
        $email = $_POST['email'];

        /*$picture = explode('.',$_FILES['picture']['name']);
        $picture_ex = end($picture);
        $picture_name = $roll.".".$picture_ex;*/

        $query = "UPDATE `users` SET `name`= '$name',`email`= '$email' WHERE `id`= '$id'";
        $result = mysqli_query($link,$query);

        if($result){
            header('location: index.php?page=user-profile');
        }

    }
?>


<div class="row">
    <div class="col-sm-6">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Student Name</label>
                <input type="text" name="name" placeholder="Student Name" id="name" class="form-control" required="" value="<?php echo $db_row['name'];?>">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" name="email" placeholder="email" id="email" class="form-control" required="" value="<?php echo $db_row['email'];?>">
            </div>

            <div class="form-group">
            <input type="submit" value="Update Profile" name="update-profile" class="btn btn-primary pull-right">

            </div>
        </form>
    </div>
</div>



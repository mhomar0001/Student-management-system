<h1 class="text-primary"><i class="fa fa-user-plus"></i> Add Student <small>Add New Student</small></h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php?page=dashboard"><i class = "fa fa-dashboard"></i> Dashboard</a></li>
                        <li class="active"><i class="fa fa-user-plus"></i> Add Student</li>
                    </ol>

<?php
require_once './dbconnection.php';

    if(isset($_POST['add-student'])){
        $name = $_POST['name'];
        $roll = $_POST['roll'];
        $city = $_POST['city'];
        $contact = $_POST['contact'];
        $class = $_POST['class'];

        $picture = explode('.',$_FILES['picture']['name']);
        $picture_ex = end($picture);
        $picture_name = $roll.".".$picture_ex;

        $query = "INSERT INTO `student_information`(`name`, `roll`, `class`, `city`, `contact`, `photo`) VALUES ('$name','$roll','$class','$city','$contact','$picture_name')";
        $result = mysqli_query($link,$query);

        if($result){
            $success = "Data Insert Success !!";
            move_uploaded_file($_FILES['picture']['tmp_name'],'student_image/'.$picture_name);
        }else{
            $error = "Data Insert Failed !!";
        }
    }
?>

<div class="row">
<?php if(isset($success)){echo '<p class="alert alert-success col-sm-6">'.$success.'</p>';}?>
<?php if(isset($error)){echo '<p class="alert alert-error col-sm-6">'.$error.'</p>';}?>

</div>

<div class="row">
    <div class="col-sm-6">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Student Name</label>
                <input type="text" name="name" placeholder="Student Name" id="name" class="form-control" required="">
            </div>

            <div class="form-group">
                <label for="roll">Student Roll</label>
                <input type="text" name="roll" placeholder="Student Roll" id="roll" class="form-control" pattern="[0-9]{6}" required="">
            </div>

            <div class="form-group">
                <label for="city">City</label>
                <input type="text" name="city" placeholder="City" id="city" class="form-control" required="">
            </div>

            <div class="form-group">
                <label for="contact">Contact</label>
                <input type="text" name="contact" placeholder="01*********" id="contact" class="form-control" required="" pattern="01[1|3|5|6|7|8|9][0-9]{8}">
            </div>

            <div class="form-group">
                <label for="class">Class</label>
                <select name="class" id="class" class="form-control" required="">
                    <option value="">Select</option>
                    <option value="1st">1st</option>
                    <option value="2nd">2nd</option>
                    <option value="3rd">3rd</option>
                    <option value="4th">4th</option>
                </select>
            </div>

            <div class="form-group">
                <label for="picture">Picture</label>
                <input type="file" name="picture" id="picture" required="">
            </div>

            <div class="form-group">
            <input type="submit" value="Add Student" name="add-student" class="btn btn-primary pull-right">

            </div>
        </form>
    </div>
</div>



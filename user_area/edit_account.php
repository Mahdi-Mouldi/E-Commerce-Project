<?php
if(isset($_GET['edit_account'])){
    $user_username=$_SESSION['username'];
    $select="select * from `user_table` where username='$user_username'";
    $res=mysqli_query($con,$select);
    $row=mysqli_fetch_array($res);
    $user_id=$row['user_id'];
    $user_email=$row['user_email'];
    $user_image=$row['user_image'];
    $user_mobile=$row['user_mobile'];
    $user_address=$row['user_adress'];
    if(isset($_POST['user_update'])){
        $update_id=$user_id;
        $username=$_POST['user_username'];
        $user_email=$_POST['user_email'];
        $user_mobile=$_POST['user_mobile'];
        $user_address=$_POST['user_address'];
        $user_image=$_FILES['user_image']['name'];
        $user_image_tmp = $_FILES['user_image']['tmp_name'];
        move_uploaded_file($user_image_tmp,"./user_images/$user_image");

        $update_query="update `user_table` set username='$username',user_email='$user_email',user_image='$user_image',
user_adress='$user_address',user_mobile='$user_mobile' where user_id='$update_id'";
        $res_update=mysqli_query($con,$update_query);
        if($res){
            echo "<script>alert('Data updated succefully')</script>";
            echo "<script>window.open('user_logout.php','_self')</script>";
        }
    }

}  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit account</title>
</head>
<body>
    <h3 class="text-center text-succes mb-4">Edit Account</h3>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-outline mb-4">
            <input type="text" class="form-control w-50 m-auto" value="<?php echo $username?>" name="user_username">
        </div>
        <div class="form-outline mb-4">
            <input type="email" class="form-control w-50 m-auto" value="<?php echo $user_email?>" name="user_email">
        </div>
        <div class="form-outline mb-4 d-flex w-50 m-auto">
            <input type="file" class="form-control" name="user_image">
            <img src="./user_images/<?php echo $user_image?>" alt="" class="update_image">
        </div>
        <div class="form-outline mb-4">
            <input type="text" class="form-control w-50 m-auto" value="<?php echo $user_address?>" name="user_address">
        </div>
        <div class="form-outline mb-4">
            <input type="text" class="form-control w-50 m-auto" value="<?php echo $user_mobile?>" name="user_mobile">
        </div>
        <div class="form-outline mb-4">
            <input type="submit" value="update" class="bg-info py-2 px-3 border-0" name="user_update">
        </div>
    </form>
</body>
</html>
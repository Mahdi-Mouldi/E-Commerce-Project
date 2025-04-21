<?php
include('../include/connect.php');
include('../functions/common_functions.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - E-Commerce</title>
    <link rel="stylesheet" href="assets/style.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
</head>
<body>
<div class="container my-5">
    <h2 class="text-center mb-4">Nouvel utilisateur - Inscription</h2>
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <form action="" method="post" enctype="multipart/form-data" class="border p-4 rounded bg-light shadow">
                <div class="mb-3">
                    <label for="user_username" class="form-label">Nom d'utilisateur</label>
                    <input type="text" id="user_username" name="user_username" class="form-control" placeholder="Entrez votre nom" required>
                </div>
                <div class="mb-3">
                    <label for="user_email" class="form-label">Email</label>
                    <input type="email" id="user_email" name="user_email" class="form-control" placeholder="exemple@mail.com" required>
                </div>
                <div class="mb-3">
                    <label for="user_password" class="form-label">Mot de passe</label>
                    <input type="password" id="user_password" name="user_password" class="form-control" placeholder="********" required>
                </div>
                <div class="mb-3">
                    <label for="user_image" class="form-label">Photo de profil</label>
                    <input type="file" id="user_image" name="user_image" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="user_address" class="form-label">Adresse</label>
                    <input type="text" id="user_address" name="user_address" class="form-control" placeholder="123 Rue, Ville" required>
                </div>
                <div class="mb-3">
                    <label for="user_mobile" class="form-label">Téléphone</label>
                    <input type="text" id="user_mobile" name="user_mobile" class="form-control" placeholder="+213 555 123 456" required>
                </div>
                <div class="text-center">
                    <input type="submit" name="register" class="btn btn-primary w-100" value="Register">
                </div>
                <p class="text-center mt-3">Vous avez déjà un compte ? <a href="user_login.php">Se connecter</a></p>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
    if(isset($_POST['register'])){
        $user_username=$_POST['user_username'];
        $user_password=$_POST['user_password'];
        $user_email=$_POST['user_email'];
        $user_address=$_POST['user_address'];
        $user_image=$_FILES['user_image']['name'];
        $user_image_tmp=$_FILES['user_image']['tmp_name'];
        $user_mobile=$_POST['user_mobile'];
        $user_ip=getIPAddress();
        $select_query="select * from `user_table` where username='$user_username'";
        $result_select=mysqli_query($con,$select_query);
        $num_row=mysqli_num_rows($result_select);
        if($num_row>0){
            echo "<script>alert('username already exist')</script>";
        }else{
        move_uploaded_file($user_image_tmp,"user_images/$user_image");
        $insert_query="insert into `user_table` (username,user_email,user_password,user_image,user_ip,user_adress,user_mobile)
        values('$user_username','$user_email','$user_password','$user_image','$user_ip','$user_address','$user_mobile')";
        $result_query=mysqli_query($con,$insert_query);
        if($result_query){
            echo "<script>alert('Data inserted succefully')</script>";
        }else{
            die(mysqli_error($con));
        }
    }
    $select_item="select * from `cart_details` where ip_adress=$user_ip";
    $result_item=mysqli_query($con,$select_item);
    $count=mysqli_num_rows($result_item);
    if($count>0){
        $_SESSION['username']=$user_username;
        echo "<script>alert('you have items in your cart')</script>";
        echo "<script>window.open('checkout.php','_self')</script>";
    }else{
        echo "<script>window.open('../index.php','_self')</script>";

    }

    }
?>
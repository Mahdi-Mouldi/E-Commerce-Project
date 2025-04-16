<?php
    include('../include/connect.php');
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registeration</title>
    <link rel="stylesheet" href="assets/style.css">

    <!--bootstrap link-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    </head>
    <!-- font awsome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" 
    integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg">
            <div class="card-header bg-primary text-white text-center">
                <h4>Create an Account</h4>
            </div>
            <div class="card-body">
                <form action="" method="POST">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="mb-3">
                    <label for="user_email" class="form-label">Email Address</label>
                    <input type="email" class="form-control" id="user_email" name="user_email" required>
                </div>
                <div class="mb-3">
                    <label for="user_password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="user_password" name="user_password" required>
                </div>
                <div class="d-grid">
                    <input type="submit" value="Register" class="bg-info py-2 px-3 border-0" name="user_register">
                    <p class="small fw_bold">Already have an account? <a href="user_login.php">Login</a></p>
                </div>
                </form>
            </div>
            </div>
        </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
<?php
    if(isset($_POST['user_register'])){
        $user_username=$_POST['username'];
        $user_email=$_POST['user_email'];
        $user_password=$_POST['user_password'];
        $insert_query="insert into `user_table` (username,user_email,user_password) values ('$user_username','$user_email','$user_password')";
        $execute_query=mysqli_query($con,$insert_query);
        if($execute_query){
            $_SESSION['username'] = $user_username;
            echo "<script>window.open('../index.php', '_self')</script>";
            echo "<script>alert('user register succefully')</script>"; 
        }else{
            die(mysqli_connect_error()); 
        }
    }
?>

<?php
    include('../include/connect.php');
    include_once '../functions/common_functions.php';
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <!-- css_link -->
    <link rel="stylesheet" href="../assets/style.css">

    <!-- bootstrap css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .profile-section {
            width: 220px;
            background-color: #5a5a5a;
            color: white;
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 20px;
            border-radius: 5px;
        }

        .profile-header {
            background-color: #00b8f0;
            padding: 10px;
            font-weight: bold;
            font-size: 18px;
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
        }

        .profile-image img {
            width: 100px;
            height: auto;
            margin: 15px 0;
        }

        .profile-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .profile-menu li {
            padding: 10px 0;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .profile-menu li a {
            color: white;
            text-decoration: none;
            display: block;
        }

        .profile-menu li a:hover {
            background-color: #444;
        }
    </style>
</head>
<body>

    <!-- nav -->

    <!-- Profile Section -->
    <div class="container-fluid p-0">
    <!--first child-->
        <nav class="navbar navbar-expand-lg navbar-light bg-info">
            <div class="container-fluid">
                <img src="../assets/images/logo.png" alt="logo" class="logo">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="../index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../display_all.php">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="user_register.php">Register</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../cart.php"><i class="fa-solid fa-cart-shopping"></i> <sup><?php cart_item(); ?></sup></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Total price: <?php total_cart_price();?></a>
                        </li>
                        
                    </ul>
                    <form class="d-flex" action="search_product.php" method="GET">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search_data">
                        <input type="submit" value="Search" class="btn btn-outline-light" name="search_data_product">
                    </form>
                </div>
            </div>
        </nav>
    <!-- second child-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
            <ul class="navbar-nav me-auto ">
                <?php
                    if(!isset($_SESSION['username'])){
                        echo "<li class='nav-item'>
                            <a class='nav-link' href='#'>Welcome Guest</a>
                </li>";  
                    }else{
                        echo "<li class='nav-item'>
                            <a class='nav-link' href='#'>Welcome ".$_SESSION['username'] ."</a>
                </li>"; 
                    }
                ?>
                
                <?php
                    if(!isset($_SESSION['username'])){
                        echo "<li class='nav-item'>
                            <a class='nav-link' href='user_area/user_login.php'>Login</a>
                </li>";

                    }else{
                        echo "<li class='nav-item'>
                            <a class='nav-link' href='user_logout.php'>Logout</a>
                </li>";
                    }
                ?>
                
            </ul>
        </nav>
        <!-- calling cat  -->
         <?php
            cart();
         ?>
        <!--third-child-->

        <div class="bg-light">
            <h3 class="text-center">
                Hidden Store
            </h3>
            <p class="text-center">Communications is at the heart of e-commerce and community</p>
        </div>
        
        <div class="container-fluid">
    <div class="row">
        <!-- Sidebar gauche (Profile Section) -->
        <div class="col-md-3">
            <div class="profile-section">
                <div class="profile-header">Your profile</div>
                <div class="profile-image">
                    <?php
                        $username=$_SESSION['username'];
                        $select_image="SELECT * FROM `user_table` WHERE username='$username'";
                        $res_image=mysqli_query($con,$select_image);
                        $row_image=mysqli_fetch_array($res_image);
                        $user_image=$row_image['user_image'];
                        echo "<img src='./user_images/$user_image' alt='Profile' />";
                    ?>
                </div>
                <ul class="profile-menu">
                    <li><a href="profile.php">Pending orders</a></li>
                    <li><a href="profile.php?edit_account">Edit Account</a></li>
                    <li><a href="profile.php?my_orders">My orders</a></li>
                    <li><a href="profile.php?delete_account">Delete Account</a></li>
                    <li><a href="user_logout.php">Logout</a></li>
                </ul>
            </div>
        </div>

        <!-- Contenu principal (get_user_details) -->
        <div class="col-md-9 mt-4   text-center">
            <?php 
            get_user_details();
            if(isset($_GET['edit_account'])){
                include('edit_account.php');
            }
            ?>
        </div>
    </div>
</div>

                    
    <!-- bootstrap js link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

<?php
    include('include/connect.php');
    include('functions/common_functions.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce Website-Cart details</title>
    <link rel="stylesheet" href="assets/style.css">

    <!--bootstrap link-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    </head>
    <!-- font awsome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" 
    integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<body>
    <div class="container-fluid p-0">
    <!--first child-->
        <nav class="navbar navbar-expand-lg navbar-light bg-info">
            <div class="container-fluid">
                <img src="assets/images/logo.png" alt="logo" class="logo">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="display_all.php">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="user_area/user_register.php">Register</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="fa-solid fa-cart-shopping"></i> <sup><?php cart_item(); ?></sup></a>
                        </li>
                        
                    </ul>
                    
                </div>
            </div>
        </nav>
    <!-- second child-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
            <ul class="navbar-nav me-auto ">
                <li class="nav-item">
                            <a class="nav-link" href="#">Welcome Guest</a>
                </li>
                <li class="nav-item">
                            <a class="nav-link" href="user_area/user_login.php">Login</a>
                </li>
            </ul>
        </nav>
        <!-- calling cat  -->
        <?php
            cart();
        ?>
        <!-- table -->
        <div class="container">

            <div class="row">
                <form action="" method="post">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th>Product Title</th>
                            <th>Product Image</th>
                            <th>Quantity</th>
                            <th>Totale price</th>
                            <th>Remove</th>
                            <th colspan="2">Operations</th>
                        </tr>
                    </thead>
                    <?php
                        global $con;
                        $get_ip_adress=getIPAddress();
                        $total_price=0;
                        $cart_query="select * from `cart_details` where ip_adress='$get_ip_adress'";
                        $result=mysqli_query($con,$cart_query);
                        while($row=mysqli_fetch_array($result)){
                            $product_id=$row['product_id'];
                            $select_products="select * from `products` where product_id='$product_id'";
                            $result_select=mysqli_query($con,$select_products);
                            while($row_product_price=mysqli_fetch_array($result_select)){
                                $product_price=$row_product_price['product_price'];
                                $product_title=$row_product_price['product_title'];
                                $product_image=$row_product_price['product_image'];
                                $total_price += $row_product_price['product_price'];
                                
                         
                    
                    ?>
                    <tbody>
                        <tr>
                            <td><?php echo $product_title?></td>
                            <td><img src="admin_area/product_images/<?php echo $product_image?>" alt="" class="cart_img"></td>
                            <td><input type="text" name="qty" id="" class="form-control"></td>
                            <!-- <?php
                                $ip=getIPAddress();
                                if(isset($_POST['update_cart'])){
                                    $quantity=$_POST['qty'];
                                    $update_query=" update `cart_details` set quantity=$quantity where ip_adress='$ip'";
                                    $result_update=mysqli_query($con,$update_query);
                                    $total_price=$total_price * $quantity;
                                }
                            ?> -->
                            <td><?php echo $product_price?>/-</td>
                            <td><input type="checkbox" name="" id=""></td>
                            <td>
                                <!-- <button class="bg-info px-3 py-2 border-0 mx-3">Update</button> -->
                                <input type="submit" value="Update Cart" class="bg-info px-3 py-2 border-0 mx-3" name="update_cart">
                                <button class="bg-info px-3 py-2 border-0 mx-3">Remove</button>
                            </td>
                        </tr>
                        <?php
                       }
                    }
                        ?>
                    </tbody>
                    <!-- php code -->
                    
                </table>
                <div class="d-flex mb-5">
                    <h4 class="px-3">
                        Subtotal: <strong class="text-info"><?php echo $total_price?>/-</strong>
                    </h4>
                    <a href="index.php"><button class="bg-info px-3 py-2 border-0 mx-3">Continue Shopping</button></a>
                    <a href="#"><button class="bg-secondary px-3 py-2 border-0">Checkout</button></a>

                </div>
                
            </div>
        </div>  
        </form>     
            <!--last child-->
        <div class="bg-info p-3 text-center ">
            <p>All rights reserved ©- Designed by Mahdi-2025</p>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

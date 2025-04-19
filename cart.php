<?php
    include('include/connect.php');
    include('functions/common_functions.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart Details</title>
    <link rel="stylesheet" href="assets/style.css">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
</head>
<body>
<div class="container-fluid p-0">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-info">
        <div class="container-fluid">
            <img src="assets/images/logo.png" alt="logo" class="logo">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link active" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="display_all.php">Products</a></li>
                    <li class="nav-item"><a class="nav-link" href="user_area/user_register.php">Register</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fa-solid fa-cart-shopping"></i> <sup><?php cart_item(); ?></sup></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Welcome/Login -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
        <ul class="navbar-nav me-auto">
            <li class="nav-item"><a class="nav-link" href="#">Welcome Guest</a></li>
            <li class="nav-item"><a class="nav-link" href="user_area/user_login.php">Login</a></li>
        </ul>
    </nav>

    <!-- PHP Cart Function -->
    <?php cart(); ?>

    <!-- Cart Table -->
    <div class="container py-4">
        <div class="row">
            <form action="" method="post">
                <table class="table table-bordered text-center">

<?php
$get_ip_address = getIPAddress();
$total_price = 0;
$cart_query = "SELECT * FROM `cart_details` WHERE ip_adress='$get_ip_address'";
$result = mysqli_query($con, $cart_query);
$count_result = mysqli_num_rows($result);

if ($count_result > 0) {
    echo '
    <thead>
        <tr>
            <th>Product Title</th>
            <th>Product Image</th>
            <th>Quantity</th>
            <th>Total Price</th>
            <th>Remove</th>
            <th colspan="2">Operations</th>
        </tr>
    </thead>
    <tbody>';

    while ($row = mysqli_fetch_array($result)) {
        $product_id = $row['product_id'];
        $quantity = $row['quantity'];

        $select_products = "SELECT * FROM `products` WHERE product_id='$product_id'";
        $result_select = mysqli_query($con, $select_products);

        while ($row_product_price = mysqli_fetch_array($result_select)) {
            $product_price = $row_product_price['product_price'];
            $product_title = $row_product_price['product_title'];
            $product_image = $row_product_price['product_image'];

            // Update quantity
            $item_total = $product_price * $quantity;
            $total_price += $item_total;
?>

<tr>
    <td><?php echo $product_title; ?></td>
    <td><img src="admin_area/product_images/<?php echo $product_image; ?>" alt="" class="cart_img" style="width: 100px;"></td>
    <td><input type="number" name="qty[<?php echo $product_id; ?>]" value="<?php echo $quantity; ?>" class="form-control text-center"></td>
    <td><?php echo $item_total; ?>/-</td>
    <td><input type="checkbox" name="removeitem[]" value="<?php echo $product_id; ?>"></td>
    <td>
        <input type="submit" value="Update Cart" class="btn btn-info mb-1" name="update_cart">
        <input type="submit" value="Remove Cart" class="btn btn-danger" name="remove_cart">
    </td>
</tr>

<?php
        }
    }
    echo '</tbody></table>';

    echo '
    <div class="d-flex justify-content-between mt-4">
        <h4>Subtotal: <span class="text-info">' . $total_price . '/-</span></h4>
        <div>
            <a href="index.php" class="btn btn-outline-info me-2">Continue Shopping</a>
            <a href="#" class="btn btn-secondary">Checkout</a>
        </div>
    </div>';
} else {
    echo "<h2 class='text-center text-danger'>Cart is empty</h2>";
    echo '<div class="text-center mt-3">
            <a href="index.php" class="btn btn-info">Continue Shopping</a>
          </div>';
}
?>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <div class="bg-info p-3 text-center">
        <p>All rights reserved © - Designed by Mahdi - 2025</p>
    </div>
</div>

<!-- Cart Update & Remove Logic -->
<?php
if (isset($_POST['update_cart']) && isset($_POST['qty'])) {
    foreach ($_POST['qty'] as $product_id => $qty) {
        $update_qty = intval($qty);
        $update_query = "UPDATE `cart_details` SET quantity=$update_qty WHERE ip_adress='$get_ip_address' AND product_id=$product_id";
        mysqli_query($con, $update_query);
    }
    echo "<script>window.open('cart.php','_self')</script>";
}

function remove_cart_item() {
    global $con;
    global $get_ip_address;
    if (isset($_POST['remove_cart']) && isset($_POST['removeitem'])) {
        foreach ($_POST['removeitem'] as $remove_id) {
            $delete_query = "DELETE FROM `cart_details` WHERE product_id=$remove_id AND ip_adress='$get_ip_address'";
            mysqli_query($con, $delete_query);
        }
        echo "<script>window.open('cart.php','_self')</script>";
    }
}
remove_cart_item();
?>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

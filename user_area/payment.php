<?php
    include('../include/connect.php');
    include_once '../functions/common_functions.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce Website - Payment</title>
    <link rel="stylesheet" href="assets/style.css">

    <!-- Bootstrap link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" 
    integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<style>
    img{
        width: 100%;
    }
</style>
<body >
    <?php
        $ip=getIPAddress();
        $select_query="select * from `user_table` where user_ip='$ip'";
        $res=mysqli_query($con,$select_query);
    ?>
    <div class="container">
        <h2 class="text-center text-info">
            Payment Options
        </h2>
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-md-6">
                <a href="https://www.paypal.com" target="_blank"><img src="../assets/images/pay.jpg" alt=""></a>
            </div>
            <div class="col-md-6">
                <a href="order.php"><h2 class="text-center">Pay offline</h2></a>
            </div>
        </div>
    </div>

        <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

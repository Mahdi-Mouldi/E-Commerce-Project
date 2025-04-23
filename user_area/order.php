<?php
    include('../include/connect.php');
    include_once '../functions/common_functions.php';
    if(isset($_GET['user_id'])){
        $user_id=$_GET['user_id'];
    }
    $get_ip=getIPAddress();
    $total_price=0;
    $cart_query_price="select * from `cart_details` where ip_adress='$get_ip'";
    $res=mysqli_query($con,$cart_query_price);
    $count_products=mysqli_num_rows($res);
    while($row_price=mysqli_fetch_array($res)){
        $product_id=$row_price['product_id'];
        $select_product="select * from `products` where product_id='$product_id'";
        $res_select=mysqli_query($con,$select_product);
        while($row_product_price=mysqli_fetch_array($res_select)){
            $product_price=array($row_product_price['product_price']);
            $product_values=array_sum($product_price);
            $total_price+=$product_values;
        }
    }
?>
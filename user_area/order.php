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
    $invoice_number=mt_rand();
    $status="pending";
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
    // getting quantity from cart
    $get_cart="select * from `cart_details`";
    $res_cart=mysqli_query($con,$get_cart);
    $get_item_quantity=mysqli_fetch_array($res_cart);
    $quantity=$get_item_quantity['quantity'];
    if($quantity==0){
        $quantity=1;
        $subtotal=$total_price;
    }else{
        $quantity=$quantity;
        $subtotal=$total_price * $quantity;

    }
    $insert_orders="insert into `user_orders` (user_id,amount_due,invoice_number,total_products,order_date,order_status) values ('$user_id','$subtotal','$invoice_number','$count_products',NOW(),'$status')";
    $res_insert=mysqli_query($con,$insert_orders);
    if($res_insert){
        echo "<script>alert('Orders are submitted succesfully')</script>";
        echo "<script>window.open('profile.php','_self')</script>";

    }
    // order pending
    $insert_pending_orders="insert into `orders_pending` (user_id,invoice_number,product_id,quantity,order_status) values ('$user_id','$invoice_number','$product_id','$quantity','$status')";
    $res_pending=mysqli_query($con,$insert_pending_orders);

    // delete items from cart
    $delete_item="delete from `cart_details` where ip_adress='$get_ip'";
    $res_delete=mysqli_query($con,$delete_item);
?>
<?php
    // include('./include/connect.php');
    function get_products(){
        if(!isset($_GET['category'])){
            if(!isset($_GET['brand'])){
        global $con;
        $select_query="select * from `products` order by rand() limit 0,9";
        $result_select=mysqli_query($con,$select_query);
        while($row=mysqli_fetch_assoc($result_select)){
            $product_id=$row['product_id'];
            $product_title=$row['product_title'];
            $product_description=$row['product_description'];
            $product_price=$row['product_price'];
            $product_image=$row['product_image'];
            $category_id=$row['category_id'];
            $brand_id=$row['brand_id'];
            echo"<div class='col-md-4'>
<div class='card' style='width: 18rem;'>
<img src='./admin_area/product_images/$product_image' class='card-img-top' alt='$product_title'>
<div class='card-body'>
<h5 class='card-title'>$product_title</h5>
<p class='card-text'>$product_description</p>
<p class='card-text'>Price: $product_price/-</p>
<a href='index.php?add_to_cart=$product_id' class='btn btn-primary'>Add to cart</a>
</div>
</div>
</div>
";
        }
    }
}
    }
    function get_all_products(){
        if(!isset($_GET['category'])){
            if(!isset($_GET['brand'])){
        global $con;
        $select_query="select * from `products` order by rand()";
        $result_select=mysqli_query($con,$select_query);
        while($row=mysqli_fetch_assoc($result_select)){
            $product_id=$row['product_id'];
            $product_title=$row['product_title'];
            $product_description=$row['product_description'];
            $product_price=$row['product_price'];
            $product_image=$row['product_image'];
            $category_id=$row['category_id'];
            $brand_id=$row['brand_id'];
            echo"<div class='col-md-4'>
<div class='card' style='width: 18rem;'>
<img src='./admin_area/product_images/$product_image' class='card-img-top' alt='$product_title'>
<div class='card-body'>
<h5 class='card-title'>$product_title</h5>
<p class='card-text'>$product_description</p>
<p class='card-text'>Price: $product_price/-</p>

<a href='index.php?add_to_cart=$product_id' class='btn btn-primary'>Add to cart</a>
</div>
</div>
</div>
";
        }
    }
}
    }
    function get_unique_category(){
        if(isset($_GET['category'])){
            $category_id=$_GET['category'];
            global $con;
        $select_query="select * from `products` where category_id=$category_id ";
        $result_select=mysqli_query($con,$select_query);
        $num_of_rows=mysqli_num_rows($result_select);
        if($num_of_rows==0){
            echo "<h2 class='text-center text-danger'>No Stock for this category</h2>";
        }
        while($row=mysqli_fetch_assoc($result_select)){
            $product_id=$row['product_id'];
            $product_title=$row['product_title'];
            $product_description=$row['product_description'];
            $product_price=$row['product_price'];
            $product_image=$row['product_image'];
            $category_id=$row['category_id'];
            $brand_id=$row['brand_id'];
            echo"<div class='col-md-4'>
<div class='card' style='width: 18rem;'>
<img src='./admin_area/product_images/$product_image' class='card-img-top' alt='$product_title'>
<div class='card-body'>
<h5 class='card-title'>$product_title</h5>
<p class='card-text'>$product_description</p>
<p class='card-text'>Price: $product_price/-</p>


<a href='index.php?add_to_cart=$product_id' class='btn btn-primary'>Add to cart</a>
</div>
</div>
</div>
";
        }
    }
}
function get_unique_brand(){
    if(isset($_GET['brand'])){
        $brand_id=$_GET['brand'];
        global $con;
    $select_query="select * from `products` where brand_id=$brand_id ";
    $result_select=mysqli_query($con,$select_query);
    $num_of_rows=mysqli_num_rows($result_select);
    if($num_of_rows==0){
        echo "<h2 class='text-center text-danger'>No Stock for this brand </h2>";
    }
    while($row=mysqli_fetch_assoc($result_select)){
        $product_id=$row['product_id'];
        $product_title=$row['product_title'];
        $product_description=$row['product_description'];
        $product_price=$row['product_price'];
        $product_image=$row['product_image'];
        $category_id=$row['category_id'];
        $brand_id=$row['brand_id'];
        echo"<div class='col-md-4'>
<div class='card' style='width: 18rem;'>
<img src='./admin_area/product_images/$product_image' class='card-img-top' alt='$product_title'>
<div class='card-body'>
<h5 class='card-title'>$product_title</h5>
<p class='card-text'>$product_description</p>
<p class='card-text'>Price: $product_price/-</p>


<a href='index.php?add_to_cart=$product_id' class='btn btn-primary'>Add to cart</a>
</div>
</div>
</div>
";
    }
}
}
    function get_brands(){
        global $con;
        $select_brands="select * from `brands`";
                        $result_brands=mysqli_query($con,$select_brands);
                        while($row_data=mysqli_fetch_assoc($result_brands)){
                            $brand_title=$row_data['brand_title'];
                            $brand_id=$row_data['brand_id'];
                            echo "<li class='nav-item'>
        <a href='index.php?brand=$brand_id' class='nav-link text-light'>$brand_title</a></li>";
                        }
    }
    function get_categories(){
        global $con;
        $select_category="select * from `categories`";
                        $result_category=mysqli_query($con,$select_category);
                        while($row=mysqli_fetch_assoc($result_category)){
                            $category_title=$row['category_title'];
                            $category_id=$row['category_id'];
                            echo "<li class='nav-item'>
        <a href='index.php?category=$category_id' class='nav-link text-light'>$category_title</a></li>";                            
                        }
    }


    function search_product(){
        global $con;
        if(isset($_GET['search_data_product'])){
        $search_data_value=$_GET['search_data'];
        $search_query="select * from `products` where product_keywords like '%$search_data_value%' ";
        $result_select=mysqli_query($con,$search_query);
        $num_of_rows=mysqli_num_rows($result_select);
        if($num_of_rows==0){
            echo "<h2 class='text-center text-danger'>this product is not found</h2>";
        }
        while($row=mysqli_fetch_assoc($result_select)){
            $product_id=$row['product_id'];
            $product_title=$row['product_title'];
            $product_description=$row['product_description'];
            $product_price=$row['product_price'];
            $product_image=$row['product_image'];
            $category_id=$row['category_id'];
            $brand_id=$row['brand_id'];
            echo"<div class='col-md-4'>
    <div class='card' style='width: 18rem;'>
    <img src='./admin_area/product_images/$product_image' class='card-img-top' alt='$product_title'>
    <div class='card-body'>
    <h5 class='card-title'>$product_title</h5>
    <p class='card-text'>$product_description</p>
<p class='card-text'>Price: $product_price/-</p>

    <a href='index.php?add_to_cart=$product_id' class='btn btn-primary'>Add to cart</a>
    </div>
    </div>
    </div>
    ";
        }
    }
}

function getIPAddress() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        // IP depuis un partage internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        // IP depuis un proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        // IP standard
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

// $ip=getIPAddress();


function cart(){
    if(isset($_GET['add_to_cart'])){
        global $con;
        $get_product_id=$_GET['add_to_cart'];
        $ip=getIPAddress();
        $select_query="select * from `cart_details` where ip_adress='$ip' and product_id=$get_product_id";
        $result_select=mysqli_query($con,$select_query);
        $num_of_rows=mysqli_num_rows($result_select);
        if($num_of_rows>0){
            echo "<script>alert('this item is already present in cart')</script>";
            echo "<script>window.open('index.php','_self')</script>";
        }else{
            $insert_query="insert into `cart_details` (product_id,ip_adress,quantity) values('$get_product_id','$ip',0)";
            $result_query=mysqli_query($con,$insert_query);
            echo "<script>alert('item is added to cart')</script>";
            echo "<script>window.open('cart.php','_self')</script>";
        }
    }
}
function cart_item(){
    if(isset($_GET['add_to_cart'])){
        global $con;
        $ip=getIPAddress();
        $select_query="select * from `cart_details` where ip_adress='$ip'  ";
        $result_select=mysqli_query($con,$select_query);
        $count_cart_items=mysqli_num_rows($result_select);

}else{
    global $con;
    $ip=getIPAddress();
    $select_query="select * from `cart_details` where ip_adress='$ip' ";
    $result_select=mysqli_query($con,$select_query);
    $count_cart_items=mysqli_num_rows($result_select);

}
echo $count_cart_items;
}

// total price function
function total_cart_price(){
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
            $total_price += $row_product_price['product_price'];
        }
    }
    echo $total_price;
}
?>

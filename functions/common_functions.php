<?php
    include('./include/connect.php');
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
<a href='#' class='btn btn-primary'>Add to cart</a>
<a href='#' class='btn btn-secondary'>View more</a>
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
<a href='#' class='btn btn-primary'>Add to cart</a>
<a href='#' class='btn btn-secondary'>View more</a>
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
        echo "<h2 class='text-center text-danger'>No Stock for this brand</h2>";
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
<a href='#' class='btn btn-primary'>Add to cart</a>
<a href='#' class='btn btn-secondary'>View more</a>
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
?>

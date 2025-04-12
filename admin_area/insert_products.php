<?php
    include('../include/connect.php');
    if(isset($_POST['insert_product'])){
        $product_title=$_POST['product_title'];
        $description=$_POST['description'];
        $product_keywords=$_POST['product_keywords'];
        $product_category=$_POST['product_categories'];
        $product_brand=$_POST['product_brands'];
        $product_price=$_POST['product_price'];
        $product_image=$_FILES['product_image']['name'];
        $temp_image=$_FILES['product_image']['tmp_name'];
        $product_status='true';
        if($product_title=='' or $description=='' or $product_keywords=='' or $product_category=='' or $product_brand=='' or $product_price=='' or $product_image=='' or $temp_image==''){
            echo "<script>alert('please fill all the available fields')</script>";
            exit();
        }else{
            move_uploaded_file($temp_image,"./product_images/$product_image");
            $insert_query="insert into `products`(product_title,category_id,brand_id,product_description,product_keywords,product_image,product_price,date,status)
            values ('$product_title','$product_category','$product_brand','$description','$product_keywords','$product_image','$product_price',NOW(),'$product_status')";
            $result_query=mysqli_query($con,$insert_query);
            if($result_query){
                echo "<script>alert('Succesfully inserted the products')</script>";
            }
        }


    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Products</title>
    <link rel="stylesheet" href="../assets/style.css">

<!--bootstrap link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<!-- font awsome link -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="text-center">Insert Products</h1>
        <form action="" method="POST" enctype="multipart/form-data">
        <!-- title -->
            <div class="from-outline mb-4 w-50 m-auto">
                <label for="product-title" class="form-label">Product title</label>
                <input type="text" name="product_title" id="product_title" class="form-control" 
                placeholder="Enter Product title" autocomplete="off" required="required">
            </div>
            <!-- description -->
            <div class="from-outline mb-4 w-50 m-auto">
                <label for="description" class="form-label">Product description</label>
                <input type="text" name="description" id="description" class="form-control" 
                placeholder="Enter Product description" autocomplete="off" required="required">
            </div>
            <!-- keywords -->
            <div class="from-outline mb-4 w-50 m-auto">
                <label for="product_keywords" class="form-label">Product Keywords</label>
                <input type="text" name="product_keywords" id="product_keywords" class="form-control" 
                placeholder="Enter Product Keywords" autocomplete="off" required="required">
            </div>
            <!-- categories -->
            <div class="from-outline mb-4 w-50 m-auto">
                <select class="form-select"  name="product_categories" id="product_categories">
                    <option selected>Select a category</option>
                    <?php
                        $select_category="select * from `categories`";
                        $result_select=mysqli_query($con,$select_category);
                        while($row=mysqli_fetch_assoc($result_select)){
                            $category_title=$row['category_title'];
                            $category_id=$row['category_id'];
                            echo "<option value='$category_id'>$category_title</option>";
                        }
                    ?> 
                </select>
            </div>
            <!-- Brands -->
            <div class="from-outline mb-4 w-50 m-auto">
                <select class="form-select"  name="product_brands" id="product_brands">
                    <option selected>Select a brand</option>
                    <?php
                        $select_brand="select * from `brands`";
                        $result_select=mysqli_query($con,$select_brand);
                        while($row=mysqli_fetch_assoc($result_select)){
                            $brand_title=$row['brand_title'];
                            $brand_id=$row['brand_id'];
                            echo "<option value='$brand_id'>$brand_title</option>";
                        }
                    ?> 
                </select>
            </div>
            <!-- image -->
            <div class="from-outline mb-4 w-50 m-auto">
                <label for="product_image" class="form-label">Product image</label>
                <input type="file" name="product_image" id="product_image" class="form-control" 
                required="required">
            </div>
            <!-- price -->
            <div class="from-outline mb-4 w-50 m-auto">
                <label for="product_price" class="form-label">Product price</label>
                <input type="text" name="product_price" id="product_price" class="form-control" 
                placeholder="Enter Product price" autocomplete="off" required="required">
            </div>
            <div class="from-outline mb-4 w-50 m-auto">
                <input type="submit" name="insert_product" class="btn btn-info" value="Insert Product">
            </div>
        </form>
    </div>
</body>
</html>
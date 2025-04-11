<?php
    include('../include/connect.php');
    if(isset($_POST['insert_cat'])){
        $category_title=$_POST['cat_title'];
        $select_query="select * from `categories` where category_title='$category_title'";
        $result_select=mysqli_query($con,$select_query);
        $number=mysqli_num_rows($result_select);
        if($number>0){
            echo "<script>alert('this category present in the database')</script>";
        }else{
            $insert_query="insert into `categories` (category_title) values ('$category_title')";
            $result_query=mysqli_query($con,$insert_query);
            if($result_query){
                echo "<script>alert('category has been inserted successfully')</script>";
            }
        }
    }
?>
<h2>Insert Categories</h2>
<form action="" method="POST" class="mb-2">
    <div class="input-group w-90 mb-3">
    <span class="input-group-text bg-info" id="basic-addon1"><i id="basic-addon1" class="fa-solid fa-receipt"></i></span>
    <input type="text" class="form-control" placeholder="insert categories" name="cat_title" aria-label="Categories" aria-describedby="basic-addon1">
    </div>
    <div class="input-group w-10 mb-2 m-auto">
        <input type="submit" class="form-control bg-info" name="insert_cat" value="Insert Categories" >
    </div>

</form>
<?php
    include('../include/connect.php');
    if(isset($_POST['insert_brand'])){
        $br_title=$_POST['brand_title'];
        $select_query="select * from `brands` where brand_title='$br_title' ";
        $result=mysqli_query($con,$select_query);
        $number=mysqli_num_rows($result);
        if($number>0){
            echo "<script>alert('this brand present in the database')</script>";
        }else{
            $insert_query="insert into `brands` (brand_title) VALUES ('$br_title') ";
            $result_query=mysqli_query($con,$insert_query);
            if($result_query){
                echo "<script>alert('brand has been inserted successfully')</script>";
            }
        }
    }
?>
<h2>Insert Brands</h2>
<form action="" method="POST" class="mb-2">
    <div class="input-group w-90 mb-3">
    <span class="input-group-text bg-info" id="basic-addon1"><i id="basic-addon1" class="fa-solid fa-receipt"></i></span>
    <input type="text" class="form-control" placeholder="insert brands" name="brand_title" aria-label="brands" aria-describedby="basic-addon1">
    </div>
    <div class="input-group w-10 mb-2 m-auto">
        <input type="submit" class="form-control bg-info" name="insert_brand" value="Insert brands" >
    </div>

</form>
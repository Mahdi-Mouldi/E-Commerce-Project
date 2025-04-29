<?php
include('../include/connect.php');
session_start();
if(isset($_GET['order_id'])){
    $order_id=$_GET['order_id'];
    $select="select * from `user_orders` where order_id='$order_id'";
    $res=mysqli_query($con,$select);
    $row=mysqli_fetch_assoc($res);
    $invoice_number=$row['invoice_number'];
    $amount=$row['amount_due'];
    if(isset($_POST['confirm_payment'])){
        $payment_mode=$_POST['payment_mode'];
        $insert="insert into `user_payments` (order_id,invoice_number,amount,payment_mode,date) values ('$order_id','$invoice_number','$amount','$payment_mode',NOW())";
        $res=mysqli_query($con,$insert);
        if($res){
            echo "<script>alert('successfully completed the payment')</script>";
            echo "<script>window.open('profile.php?my_orders','_self')</script>";
        }
    }
    $update_status="update `user_orders` set order_status='Complete'";
    $res_up=mysqli_query($con,$update_status);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Confirm Payment</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
        crossorigin="anonymous">
  <style>
    body {
      background-color: #5e5e5e;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .form-container {
      background-color: #5e5e5e;
      color: white;
      padding: 30px;
      border-radius: 10px;
      width: 350px;
    }

    .btn-confirm {
      background-color: #00bfff;
      border: none;
      width: 100%;
    }

    .btn-confirm:hover {
      background-color: #00a3cc;
    }
  </style>
</head>
<body>

  <div class="form-container text-center">
    <h3 class="mb-4">Confirm Payment</h3>
    <form action="" method="POST">
      <div class="mb-3">
        <input type="text" class="form-control" placeholder="invoice_number" value="<?php echo $invoice_number ?>">
      </div>
      <div class="mb-3 text-start">
        <label for="amount" class="form-label">Amount:</label>
        <input type="text" class="form-control" name="amount" value="<?php echo $amount ?>">
      </div>
      <div class="mb-4">
        <select class="form-select" name="payment_mode">
          <option selected>Select Payment mode</option>
          <option value="credit">Credit Card</option>
          <option value="paypal">PayPal</option>
          <option value="bank">Bank Transfer</option>
          <option value="pay offline">Pay Offline</option>
        </select>
      </div>
      <input type="submit" class="btn btn-confirm" value="Confirm" name="confirm_payment">
    </form>
  </div>

</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Order Row</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <style>
    thead {
      background-color: #00bfff; /* Bleu ciel */
      color: white;
    }
    tbody tr {
      background-color: #4d4d4d; /* Gris foncé */
      color: white;
    }
    a.confirm-link {
      color: lightblue;
      text-decoration: underline;
    }
  </style>
</head>
<body>

  <div class="container mt-5">
    <table class="table table-bordered text-center">
      <thead>
        <?php
           $username=$_SESSION['username'];
           $get_user="select * from `user_table` where username='$username'";
           $res=mysqli_query($con,$get_user);
           $row=mysqli_fetch_assoc($res);
           $user_id=$row['user_id'];
        ?>
        <tr>
          <th>Sl no</th>
          <th>Amount Due</th>
          <th>Total products</th>
          <th>Invoice number</th>
          <th>Date</th>
          <th>Complete/Incomplete</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <?php
      $select_query="select * from  `user_orders` where user_id='$user_id'";
           $res_select=mysqli_query($con,$select_query);
           $number=1;
           while($row_order=mysqli_fetch_assoc($res_select)){
            $amount_due=$row_order['amount_due'];
            $invoice_number=$row_order['invoice_number'];
            $total_products=$row_order['total_products'];
            $order_date=$row_order['order_date'];
            $order_status=$row_order['order_status'];
            $amount_due=$row_order['amount_due'];
              echo "<tr>
          <td>$number</td>
          <td> $amount_due</td>
          <td> $total_products</td>
          <td>  $invoice_number</td>
          <td> $order_date</td>
          <td> $order_status</td>
          <td><a href='confirm_payment.php'>Confirm</td>
        </tr>";
        $number++;
           }
           ?>
        
      </tbody>
    </table>
  </div>

</body>
</html>

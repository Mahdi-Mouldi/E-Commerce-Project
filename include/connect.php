<?php
$con = mysqli_connect('localhost:3307', 'root', '', 'e_commerce');

if ($con) {
    echo "Connection is successful";
} else {
    die('Connection failed: ' . mysqli_connect_error());  
}
?>

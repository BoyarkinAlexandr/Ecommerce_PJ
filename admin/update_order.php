<?php

$conn = mysqli_connect("localhost", "root", "", "php_kurs");

$order_id = $_GET['id'];

$delivered = "Доставленно";

$sql = "UPDATE orders set status = '$delivered' where id='$order_id'";

$result = mysqli_query($conn, $sql);

if($result)
{
    header("location:all_orders.php");
}

?>
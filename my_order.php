<?php

    session_start();

    $_SESSION['user_email'] = $_GET['email'];

$conn = mysqli_connect("localhost", "root", "", "php_kurs");

$p_id = $_GET['id'];

$u_email = $_GET['email'];


$p_sql = "SELECT * from products where id = '$p_id'";

$p_result = mysqli_query($conn, $p_sql);

$p_row = mysqli_fetch_assoc($p_result);




$p_title = $p_row['title'];

$p_price = $p_row['price'];

$p_image = $p_row['image'];


$u_sql = "Select * from users where email = '$u_email'";

$u_result = mysqli_query($conn, $u_sql);

$u_row = mysqli_fetch_assoc($u_result);

$u_name = $u_row['name'];

$u_email = $u_row['email'];

$u_phone = $u_row['phone'];

$u_address = $u_row['address'];

$status = "В процессе";



$order_sql = "Insert into orders(title,price,image,username,email,phone,address,status) 
VALUES ('$p_title','$p_price','$p_image','$u_name','$u_email','$u_phone','$u_address', '$status')";



$order_result = mysqli_query($conn, $order_sql);

if($order_result)

{
    $_SESSION['user_email'] = $_GET['email'];
    
    header("location:user_order.php");
}



?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title></title>
</head>
<body>

<nav>
        <input type="checkbox" id="check">


        <label for="check" class="checkbtn">
            <i class="fa fa-bars"></i>
        </label>
        <label class="my_logo">
            <a style="color:white;" href="index.php">АВТОСТРАХОВАНИЕ</a>
        </label>

        <ul>
            <li>
                <a href="index.php">Домой</a>
            </li>

            <li>
                <a href="product.php">Продукты</a>
            </li>

            <?php

            if($_SESSION['user_email'])
            {
            
            ?>

            <a class ="logout_btn" href="logout.php">Выйти</a>

            <?php
            
            }

            else

            {

            ?>

            <li>
                <a href="home/register.php">Регистрация</a>
            </li>

            <li>
                <a href="home/login.php">Вход</a>
            </li>



            <?php

            }

            ?>

        </ul>



    </nav>
    
</body>
</html>
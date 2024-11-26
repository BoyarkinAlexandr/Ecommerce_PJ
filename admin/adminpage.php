<?php

    session_start();

    $conn = mysqli_connect("localhost","root","","php_kurs");

    if(!isset($_SESSION['user_email']))
    {

        header("location:../home/login.php");
    }
    elseif ($_SESSION['usertype'] == "user")
    {
        header("location:../home/login.php");
    }


    $user_sql = "SELECT * from users";

    $u_result = mysqli_query($conn, $user_sql);

    $total_user = mysqli_num_rows($u_result);



    $product_sql = "SELECT * from products";

    $p_result = mysqli_query($conn, $product_sql);

    $total_product = mysqli_num_rows($p_result);



    $order_sql = "SELECT * from orders";

    $o_result = mysqli_query($conn, $order_sql);

    $total_order = mysqli_num_rows($o_result);




    $del_sql = "SELECT * from orders where status= 'Доставленно'";

    $d_result = mysqli_query($conn, $del_sql);

    $total_del = mysqli_num_rows($d_result);

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" type="text/css" href="admin_style.css">
</head>
<body>
    
    <div class="wrapper">
        <div class="sidebar">

            <h2>Панель Администратора</h2>

            <ul>
                <li>
                    <a href="adminpage.php">Панель инструментов</a>
                </li>
                <li>
                    <a href="users.php">Пользователи</a>
                </li>
                <li>
                    <a href="add_product.php">Добавить продукт</a>
                </li>
                <li>
                    <a href="display_product.php">Посмотреть продукт</a>
                </li>

                <li>
                    <a href="all_orders.php">Заказы</a>
                </li>
            </ul>


        </div>

        <div class="header">
            <div class="admin_header">
                <a href="../logout.php">Выйти</a>
            </div>

            <div class="info">
                <div class="card">
                    <div class="my_card">
                        <h3>Количество пользователей</h3>
                        <hr>
                        <p><?php echo $total_user ?></p>
                    </div>

                    <div class="my_card">
                        <h3>Количество Продуктов</h3>
                        <hr>
                        <p><?php echo $total_product ?></p>
                    </div>

                    <div class="my_card">
                        <h3>Количество Заказов</h3>
                        <hr>
                        <p><?php echo $total_order ?></p>
                    </div>


                    <div class="my_card">
                        <h3>Количество приобретённых</h3>
                        <hr>
                        <p><?php echo $total_del ?></p>
                    </div>
                </div>
            </div>
        </div>


    </div>
</body>
</html>
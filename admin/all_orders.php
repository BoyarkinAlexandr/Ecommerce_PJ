<?php

    session_start();

    $conn = mysqli_connect("localhost", "root", "", "php_kurs");

    if(!isset($_SESSION['user_email']))
    {

        header("location:../home/login.php");
    }
    elseif ($_SESSION['usertype'] == "user")
    {
        header("location:../home/login.php");
    }

    $sql = "Select * from orders";

    $result = mysqli_query($conn, $sql);

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
                <h1>Все Заказы</h1>

                <table>
                    <tr>
                        <th>Имя покупателя</th>
                        <th>Email</th>
                        <th>Адресс</th>
                        <th>Номер</th>
                        <th>Название</th>
                        <th>Цена</th>
                        <th>Фото</th>
                        <th>Статус заказа</th>
                        <th>Изменить статус</th>
                    </tr>


                    <?php
                    while($row=mysqli_fetch_assoc($result))

                    {
                    ?>

                    <tr>
                        <td><?php echo $row['username'] ?></td>
                        <td><?php echo $row['email'] ?>/td>
                        <td><?php echo $row['address'] ?></td>
                        <td><?php echo $row['phone'] ?></td>
                        <td><?php echo $row['title'] ?></td>
                        <td><?php echo $row['price'] ?></td>
                        <td>
                            <img width="100" height="100" src="../product_image/<?php echo $row['image'] ?>">
                        </td>
                        <td><?php echo $row['status'] ?></td>


                        <td>
                            <a class="del_btn" href="update_order.php?id=<?php echo $row['id'] ?>">Приобретено</a>
                        </td>
                    </tr>


                    <?php

                    }


                    ?>

                    
                </table>

            </div>
        </div>


    </div>
</body>
</html>
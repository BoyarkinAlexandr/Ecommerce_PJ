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

    $is_user="user";
    $sql = "SELECT * from users where usertype = '$is_user'";

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
                <h1>Все Пользователи</h1>

                <table>
                    <tr>
                        <th>Имя пользователя</th>
                        <th>Email</th>
                        <th>Телефон</th>
                        <th>Адресс</th>
                    </tr>


                    <?php

                    while($row=mysqli_fetch_assoc($result))

                    {
                    ?>

                    <tr>
                        <td><?php echo $row['name'] ?></td>
                        <td><?php echo $row['email'] ?><AAAA/td>
                        <td><?php echo $row['phone'] ?></td>
                        <td><?php echo $row['address'] ?></td>
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
<?php

    session_start();

    if(!isset($_SESSION['user_email']))
    {

        header("location:../home/login.php");
    }
    elseif ($_SESSION['usertype'] == "user")
    {
        header("location:../home/login.php");
    }

    $conn = mysqli_connect("localhost","root","","php_kurs");


    if(isset($_GET['id']))
    {
        $p_id = $_GET['id'];

        $del_sql = "DELETE from products where id='$p_id'";

        $data = mysqli_query($conn, $del_sql);

        if($data)
        {
            header("location:display_product.php");
        }
    }

    $sql = "SELECT * from products";

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
                    <a href="#">Панель инструментов</a>
                </li>
                <li>
                    <a href="#">Пользователи</a>
                </li>
                <li>
                    <a href="add_product.php">Добавить продукт</a>
                </li>
                <li>
                    <a href="display_product.php">Посмотреть продукт</a>
                </li>
            </ul>


        </div>

        <div class="header">
            <div class="admin_header">
                <a href="../logout.php">Выйти</a>
            </div>

            <div class="info">
                <h1>Все продукты</h1>


                <table>
                    <tr>
                        <th>Название</th>
                        <th>Описание</th>
                        <th>Количество</th>
                        <th>Цена</th>
                        <th>Фото</th>
                        <th>Удалить</th>
                        <th>Обновить</th>
                    </tr>


                <?php

                while($row=mysqli_fetch_assoc($result))

                {
                ?>

                <tr>
                        <td><?php echo $row['title'] ?></td>
                        <td><?php echo $row['description'] ?></td>
                        <td><?php echo $row['quantity'] ?></td>
                        <td><?php echo $row['price']?></td>
                        <td>
                            <img height="100" width="100" src="../product_image/<?php echo $row['image']?>">
                        </td>

                        <td>
                            <a onclick="return confirm('Вы точно хотите удалить?');"
                            class="del_btn" href="display_product.php?id=<?php echo $row['id']?>">Удалить</a>
                        </td>

                        <td>
                            <a class="upd_btn" href="update_product.php?id=<?php echo $row['id'] ?>">Обновить</a>
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
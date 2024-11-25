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
                    <a href="#">Добавить продукт</a>
                </li>
                <li>
                    <a href="#">Посмотреть продукт</a>
                </li>
            </ul>


        </div>

        <div class="header">
            <div class="admin_header">
                <a href="#">Выйти</a>
            </div>

            <div class="info">
                adasddasasmdaksldmasdmamklsdkamsdlkmasdmaskldkmaslkdmaksdmkaskmdakms
            </div>
        </div>


    </div>
</body>
</html>
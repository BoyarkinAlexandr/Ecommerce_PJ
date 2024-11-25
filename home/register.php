<?php

$conn = mysqli_connect("localhost","root","","php_kurs");


    if(isset($_POST['register']))
    {
        $u_name = $_POST['name'];
        $u_email = $_POST['email'];
        $u_address = $_POST['address'];
        $u_phone = $_POST['phone'];
        $u_pass = $_POST['password'];
        $usertype = "user";



        $sql = "INSERT INTO users (name, email, password, phone, address, usertype) VALUES ('$u_name', '$u_email', 
        '$u_pass', '$u_phone', '$u_address', '$usertype')";

        $data = mysqli_query($conn,$sql);

        if($data)
        {
            echo "Вы Успешно Зарегистрированы";
        }

    }


?>










<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>

    <link rel="stylesheet" type="text/css" href="../style.css">
</head>
<body>


    <div class="my_form">

        <h2>Форма Регистрация</h2>

        <form action="" method="POST">
            
        
            <div class="input_deg">
                <label>Имя:</label>
                <input type="text" name="name">
            </div>

            <div class="input_deg">
                <label>email:</label>
                <input type="email" name="email">
            </div>

            <div class="input_deg">
                <label>Телефон:</label>
                <input type="number" name="phone">
            </div>

            <div class="input_deg">
                <label>Адресс:</label>
                <input type="text" name="address">
            </div>


            <div class="input_deg">
                <label>Пароль:</label>
                <input type="password" name="password">
            </div>


            <div class="input_deg">
                <input type="submit" name="register" value="Зарегистрироваться">
            </div>




        </form>
    
    </div>
    

    
</body>
</html>
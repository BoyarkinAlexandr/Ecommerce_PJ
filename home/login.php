<?php

session_start();
error_reporting(0);
$conn = mysqli_connect("localhost","root","","php_kurs");

    if(isset($_POST['login']))
    {
        $u_email = $_POST['email'];
        $u_pass = $_POST['password'];


        $sql = "SELECT * from users Where email ='".$u_email."' AND password = '".$u_pass."' ";

        $result = mysqli_query($conn,$sql);

        $row = mysqli_fetch_array($result);

        if($row['usertype'] == "user")
        {
            $_SESSION['user_email']=$u_email;

            $_SESSION['usertype']="user";
            header("location:../index.php");
        }


        else if($row['usertype'] == "admin")
        {
            $_SESSION['user_email']=$u_email;

            $_SESSION['usertype']="admin";
            header("location:../admin/adminpage.php");
        }

        else
        {
            $_SESSION['message']="Логин или Пароль не правильные";
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
    
    <div class = "my_form">

        <h2>
            <?php
               echo $_SESSION['message'];
            ?>

        </h2>

        <h2>АВТОРИЗАЦИЯ</h2>

    <form action="" method="POST">
        <div class = "input_deg">
            <label>Email</label>
            <input type="email" name="email" require>
        </div>


        <div class="input_deg">
            <div class="password-container">
                <label>Пароль</label>
                <input type="password" name="password" id="password" required>
                <span id="toggle-icon" onclick="togglePassword()">👁️</span>
            </div>
        </div>

        <div class = "input_deg">
            <input type="submit" name="login" value = "Войти">
        </div>




    </form>
    </div>

    <script>
    // Функция для переключения видимости пароля
    function togglePassword() {
        const passwordField = document.getElementById("password");
        const toggleIcon = document.getElementById("toggle-icon");
        if (passwordField.type === "password") {
            passwordField.type = "text"; // Показываем пароль
            toggleIcon.textContent = "🙈";  // Меняем символ на скрыть
        } else {
            passwordField.type = "password"; // Скрываем пароль
            toggleIcon.textContent = "👁️";  // Меняем символ на показать
        }
    }
    </script>
    
</body>
</html>
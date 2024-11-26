<?php
$conn = mysqli_connect("localhost", "root", "", "php_kurs");

if (isset($_POST['register'])) {
    $u_name = $_POST['name'];
    $u_email = $_POST['email'];
    $u_address = $_POST['address'];
    $u_phone = $_POST['phone'];
    $u_pass = $_POST['password'];
    $usertype = "user";

    // Серверная валидация
    if (!preg_match("/^[a-zA-Zа-яА-ЯёЁ\s]+$/u", $u_name)) {
        echo "Ошибка: Имя должно содержать только буквы.";
    } elseif (!preg_match("/^\d+$/", $u_phone)) {
        echo "Ошибка: Телефон должен содержать только цифры.";
    } else {
        $sql = "INSERT INTO users (name, email, password, phone, address, usertype) VALUES ('$u_name', '$u_email', 
        '$u_pass', '$u_phone', '$u_address', '$usertype')";

        $data = mysqli_query($conn, $sql);

        if ($data) {
            echo "Вы успешно зарегистрированы";
        } else {
            echo "Ошибка при регистрации: " . mysqli_error($conn);
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Форма регистрации</title>
    <link rel="stylesheet" type="text/css" href="../style.css">
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

        // Функция для блокировки ввода букв в поле телефона
        function restrictPhoneInput(event) {
            // Запрещаем ввод символов, которые не являются цифрами
            const charCode = event.charCode || event.keyCode;
            if (charCode < 48 || charCode > 57) {
                event.preventDefault();  // Блокируем символ
            }
        }

        // Дополнительная валидация на стороне клиента
        function validateForm() {
            const name = document.forms["registerForm"]["name"].value;
            const phone = document.forms["registerForm"]["phone"].value;

            // Проверка имени на наличие только букв
            if (!/^[a-zA-Zа-яА-ЯёЁ\s]+$/.test(name)) {
                alert("Имя должно содержать только буквы.");
                return false;
            }

            // Проверка телефона на наличие только цифр
            if (!/^\d+$/.test(phone)) {
                alert("Телефон должен содержать только цифры.");
                return false;
            }

            return true;
        }
    </script>
    <style>
        /* Контейнер для пароля и иконки */
        .password-container {
            position: relative;
            width: 100%;
        }

        /* Стиль для поля ввода пароля */
        .password-container input[type="password"] {
            width: 40%;
            padding: 12px;
            resize: vertical;
            box-sizing: border-box;
        }

        /* Стиль для иконки внутри поля */
        .password-container span {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            font-size: 1.5em;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="my_form">
        <h2>Форма Регистрация</h2>
        <form name="registerForm" action="" method="POST" onsubmit="return validateForm()">
            <div class="input_deg">
                <label>Имя:</label>
                <input type="text" name="name" required pattern="^[a-zA-Zа-яА-ЯёЁ\s]+$">
            </div>
            <div class="input_deg">
                <label>Email:</label>
                <input type="email" name="email" required>
            </div>
            <div class="input_deg">
                <label>Телефон:</label>
                <input type="tel" name="phone" required pattern="^\d+$" onkeypress="restrictPhoneInput(event)">
            </div>
            <div class="input_deg">
                <label>Адресс:</label>
                <input type="text" name="address" required>
            </div>
            <div class="input_deg password-container">
                <label>Пароль:</label>
                <input type="password" name="password" id="password" required>
                <!-- Иконка для переключения видимости пароля -->
                <span id="toggle-icon" onclick="togglePassword()">👁️</span>
            </div>
            <div class="input_deg">
                <input type="submit" name="register" value="Зарегистрироваться">
            </div>
            <div class="input_deg">
                <a href="../logout.php">Выйти</a>
            </div>
            
        </form>
    </div>
</body>
</html>

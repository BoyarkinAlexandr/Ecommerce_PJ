<?php
    session_start();

    // Проверка, если пользователь не авторизован или не имеет прав администратора
    if(!isset($_SESSION['user_email'])) {
        header("location:../home/login.php");
    } elseif ($_SESSION['usertype'] == "user") {
        header("location:../home/login.php");
    }

    // Подключение к базе данных
    $conn = mysqli_connect("localhost", "root", "", "php_kurs");

    // Проверка, если форма была отправлена
    if (isset($_POST['add_product'])) {
        // Получаем данные из формы
        $title = trim($_POST['title']);
        $des = trim($_POST['description']);
        $price = $_POST['price'];
        $qty = $_POST['qty'];

        // Проверка обязательных полей
        if (empty($title) || empty($des) || empty($price) || empty($qty)) {
            echo "Все поля должны быть заполнены!";
        } else {
            // Обработка изображения
            $image_name = $_FILES['my_image']['name'];
            $tmp = explode(".", $image_name);
            $newfilename = round(microtime(true)) . '.' . end($tmp);
            $uploadpath = "../product_image/" . $newfilename;

            // Проверка на ошибки загрузки файла
            if ($_FILES['my_image']['error'] === UPLOAD_ERR_OK) {
                if (move_uploaded_file($_FILES['my_image']['tmp_name'], $uploadpath)) {
                    echo "Файл успешно перемещён!";
                } else {
                    echo "Ошибка перемещения файла!";
                    var_dump($_FILES['my_image']['error']);
                }
            } else {
                echo "Ошибка при загрузке файла. Код ошибки: " . $_FILES['my_image']['error'];
            }

            // Вставка данных в базу данных
            $sql = "INSERT into products(title, description, price, quantity, image) 
                    VALUES ('$title', '$des', '$price', '$qty', '$newfilename')";

            // Выполнение запроса
            $data = mysqli_query($conn, $sql);

            // Проверка успешности выполнения запроса
            if ($data) {
                header('location:add_product.php');
            } else {
                echo "Ошибка при добавлении продукта!";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавить продукт</title>

    <link rel="stylesheet" type="text/css" href="admin_style.css">
</head>
<body>
    
    <div class="wrapper">
        <div class="sidebar">
            <h2>Панель Администратора</h2>

            <ul>
                <li><a href="adminpage.php">Панель инструментов</a></li>
                <li><a href="users.php">Пользователи</a></li>
                <li><a href="add_product.php">Добавить продукт</a></li>
                <li><a href="display_product.php">Посмотреть продукт</a></li>
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
                <h1>Добавить продукт</h1>

                <div class="my_form">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="div_deg">
                            <label>Название</label>
                            <input type="text" name="title">
                        </div>

                        <div class="div_deg">
                            <label>Описание</label>
                            <textarea name="description"></textarea>
                        </div>

                        <div class="div_deg">
                            <label>Цена</label>
                            <input type="number" name="price">
                        </div>

                        <div class="div_deg">
                            <label>Количество</label>
                            <input type="number" name="qty">
                        </div>

                        <div class="div_deg">
                            <label>Фото продукта</label>
                            <input type="file" name="my_image">
                        </div>

                        <div class="div_deg">
                            <input type="submit" name="add_product" value="Добавить продукт">
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</body>
</html>

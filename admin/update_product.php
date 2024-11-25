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

    $p_id = $_GET['id'];

    $sql = "SELECT * from products where id='$p_id'";

    $result = mysqli_query($conn, $sql);

    $row = mysqli_fetch_assoc($result);


    if(isset($_POST['update_product']))
    {
        $p_title = $_POST['title'];

        $p_des = $_POST['description'];

        $p_price = $_POST['price'];

        $p_qty = $_POST['qty'];



        $image_name = $_FILES['my_image']['name'];

        if($image_name)

        {
            $tmp = explode(".", $image_name);
        $newfilename = round(microtime(true)) . '.' . end($tmp);
        $uploadpath = "../product_image/" . $newfilename;

        move_uploaded_file($_FILES['my_image']['tmp_name'], $uploadpath);


        $update_sql = "Update products set title = '$p_title', description = '$p_des', price = '$p_price', quantity = '$p_qty', image = '$newfilename' where id ='$p_id'";

        $data = mysqli_query($conn, $update_sql);


        // Проверка успешности выполнения запроса
        if ($data) {
            header('location:display_product.php');
        } else {
            echo "Ошибка при обновлении продукта!";
        }

        }

        else
        {

            $update_sql = "Update products set title = '$p_title', description = '$p_des', price = '$p_price', quantity = '$p_qty' where id ='$p_id'";

            $data = mysqli_query($conn, $update_sql);
    
    
            // Проверка успешности выполнения запроса
            if ($data) {
                header('location:display_product.php');
            } else {
                echo "Ошибка при обновлении продукта!";
            }

        }


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
                <h1>Обновить</h1>

                <div class="my_form">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="div_deg">
                            <label>Название</label>
                            <input type="text" value="<?php echo $row['title']?>" name="title">
                        </div>

                        <div class="div_deg">
                            <label>Описание</label>
                            <textarea name="description"><?php echo $row['description']?>

                            </textarea>
                        </div>

                        <div class="div_deg">
                            <label>Цена</label>
                            <input type="number" value="<?php echo $row['price']?>" name="price">
                        </div>

                        <div class="div_deg">
                            <label>Количество</label>
                            <input type="number" value="<?php echo $row['quantity']?>" name="qty">
                        </div>

                        <div>
                            <label>Используемое фото</label>
                            <img width="80" height="80" src="../product_image/<?php echo $row['image']?>">
                        </div>

                        <div class="div_deg">
                            <label>Изменить Фото продукта</label>
                            <input type="file" name="my_image">
                        </div>

                        <div class="div_deg">
                            <input type="submit" class="upd_btn" name="update_product" value="Обновить продукт">
                        </div>
                    </form>
                </div>
               
            </div>
        </div>


    </div>
</body>
</html>
<?php

error_reporting(0);

$conn = mysqli_connect("localhost", "root", "", "php_kurs");

session_start();


$my_email = $_SESSION['user_email'];

$user_email = $_GET['email'];

if($my_email)

{
    $sql = "Select * from orders where email = '$my_email'";

$result = mysqli_query($conn, $sql);

}


else if($user_email)

{
    $sql = "Select * from orders where email = '$user_email'";

    $result = mysqli_query($conn, $sql);

}

else
{
    header("location:home/login.php");
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title></title>
</head>
<body>

<nav>
        <input type="checkbox" id="check">


        <label for="check" class="checkbtn">
            <i class="fa fa-bars"></i>
        </label>
        <label class="my_logo">АВТОСТРАХОВАНИЕ</label>

        <ul>
            <li>
                <a href="#">Домой</a>
            </li>

            <li>
                <a href="#">Продукты</a>
            </li>

            <li>
                <a href="#">Контактые данные</a>
            </li>

            <?php

            if($_SESSION['user_email'])
            {
            
            ?>

            <a class ="logout_btn" href="user_order.php?email=<?php echo $_SESSION['user_email'] ?>">Заказы</a>

            <a class ="logout_btn" href="logout.php">Выйти</a>

            <?php
            
            }

            else

            {

            ?>

            <li>
                <a href="home/register.php">Регистрация</a>
            </li>

            <li>
                <a href="home/login.php">Вход</a>
            </li>



            <?php

            }

            ?>

        </ul>



    </nav>

    <table>

        <tr>
            <th>Название продукта</th>
            <th>Цена</th>
            <th>Фото</th>
        </tr>

        <?php

        while($row=mysqli_fetch_assoc($result))
        {
        ?>

        <tr>
            <td><?php echo $row['title'] ?></td>
            <td><?php echo $row['price'] ?></td>
            <td>
                <img width="100" height="100" src="product_image/<?php echo $row['image'] ?>">
            </td>
        </tr>


        <?php
        }

        ?>


        
    </table>
    
</body>
</html>
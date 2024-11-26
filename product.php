<?php

session_start();
error_reporting(0);


$conn = mysqli_connect("localhost","root","","php_kurs");

if(isset($_GET['search']))
{
    $search_value = $_GET['my_search'];
    $sql = "SELECT * from products Where concat(title, description) LIKE '%$search_value%'";

    $result = mysqli_query($conn, $sql);

}

else
{
    $sql = "SELECT * from products";

    $result = mysqli_query($conn, $sql);

}

?>







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" type="text/css" href="style.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    
    <nav>
        <input type="checkbox" id="check">


        <label for="check" class="checkbtn">
            <i class="fa fa-bars"></i>
        </label>
        <label class="my_logo">
            <a style="color:white;" href="index.php">АВТОСТРАХОВАНИЕ</a>
        </label>

        <ul>
            <li>
                <a href="index.php">Домой</a>
            </li>

            <li>
                <a href="product.php">Продукты</a>
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


    <div>
        <h3 class="p_title">Продукты</h3>
    </div>

    <div style="margin-left:500px; padding: 100px;">
        <form action="" method="GET">
            <input type="text" name="my_search" placeholder="Найти продукт..">

            <input type="submit" name="search" value="Поиск">

        </form>
    </div>


    <div class="my_card">


        <?php

        while($row=mysqli_fetch_assoc($result))

        {
        
        ?>

        <div class="card">
            <img class="p_image" src="product_image/<?php echo $row['image'] ?>">
            <h4><?php echo $row['title'] ?></h4>

            <p><?php echo $row['description'] ?></p>

            <p>Цена: <?php echo $row['price'] . ' Руб' ?></p>


            <?php

            if($_SESSION['user_email'])


            {
            ?>
                <a href="my_order.php?id=<?php echo $row['id'] ?> & email=<?php echo $_SESSION['user_email']?>">Купить сейчас</a>
            
            
            <?php
            }

            else

            {
            ?>
                <a href="home/login.php">Купить сейчас</a>

            <?php
            }


            ?>

            

        </div>


        <?php
        }

        ?>

    
    </div>

    

    
    
</body>
</html>
<?php
$conn = mysqli_connect("localhost","root","","php_kurs");

$sql = "SELECT * from products";

$result = mysqli_query($conn, $sql);




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

            <li>
                <a href="home/register.php">Регистрация</a>
            </li>

            <li>
                <a href="home/login.php">Вход</a>
            </li>



        </ul>



    </nav>

    <div>
        <img class="my_insurance" src="insurance1.png">
    </div>

    <div>
        <h3 class="p_title">Продукты</h3>
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

            <p><?php echo $row['price'] ?></p>

            <a href="">Купить сейчас</a>

        </div>


        <?php
        }

        ?>

    
    </div>

    

    
    
</body>
</html>
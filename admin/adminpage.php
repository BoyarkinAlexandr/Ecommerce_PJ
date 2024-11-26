<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "php_kurs");

if (!isset($_SESSION['user_email'])) {
    header("location:../home/login.php");
} elseif ($_SESSION['usertype'] == "user") {
    header("location:../home/login.php");
}

// Количество пользователей
$user_sql = "SELECT * from users";
$u_result = mysqli_query($conn, $user_sql);
$total_user = mysqli_num_rows($u_result);

// Количество продуктов
$product_sql = "SELECT * from products";
$p_result = mysqli_query($conn, $product_sql);
$total_product = mysqli_num_rows($p_result);

// Количество заказов
$order_sql = "SELECT * from orders";
$o_result = mysqli_query($conn, $order_sql);
$total_order = mysqli_num_rows($o_result);

// Заказы доставлены
$del_sql = "SELECT * from orders WHERE status = 'Доставленно'";
$d_result = mysqli_query($conn, $del_sql);
$total_del = mysqli_num_rows($d_result);

// Заказы в процессе
$process_sql = "SELECT * from orders WHERE status = 'В процессе'";
$p_result = mysqli_query($conn, $process_sql);
$total_process = mysqli_num_rows($p_result);

// Количество заказов по каждому пользователю
$user_orders_sql = "SELECT username, COUNT(*) as order_count FROM orders GROUP BY username";
$user_orders_result = mysqli_query($conn, $user_orders_sql);

$usernames = [];
$order_counts = [];

while ($row = mysqli_fetch_assoc($user_orders_result)) {
    $usernames[] = $row['username']; // Имена пользователей
    $order_counts[] = $row['order_count']; // Количество заказов
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Панель Администратора</title>

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
                <li><a href="all_orders.php">Заказы</a></li>
            </ul>
        </div>

        <div class="header">
            <div class="admin_header">
                <a href="../logout.php">Выйти</a>
            </div>

            <div class="info">
                <div class="card">
                    <div class="my_card">
                        <h3>Количество пользователей</h3>
                        <hr>
                        <p><?php echo $total_user ?></p>
                    </div>

                    <div class="my_card">
                        <h3>Количество Продуктов</h3>
                        <hr>
                        <p><?php echo $total_product ?></p>
                    </div>

                    <div class="my_card">
                        <h3>Количество Заказов</h3>
                        <hr>
                        <p><?php echo $total_order ?></p>
                    </div>

                    <div class="my_card">
                        <h3>Количество приобретённых</h3>
                        <hr>
                        <p><?php echo $total_del ?></p>
                    </div>
                </div>
            </div>
        <div class="chart-container-wrapper" style="display: flex; justify-content: space-between; padding-top: 20px;">

            <!-- Диаграмма статусов заказов слева -->
            <div class="chart-container" style="width: 45%; padding-top: 20px;">
                <canvas id="orderStatusChart"></canvas>
            </div>

            <!-- Диаграмма заказов по пользователям справа -->
            <div class="chart-container" style="width: 45%; padding-top: 20px;">
                <canvas id="userOrdersChart"></canvas>
            </div>
        </div>
        </div>
    </div>

    <script>
    // Круговая диаграмма - Статусы заказов
    const ctx = document.getElementById('orderStatusChart').getContext('2d');
    const orderStatusChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Доставлено', 'В процессе'],
            datasets: [{
                label: 'Статусы заказов',
                data: [<?php echo $total_del; ?>, <?php echo $total_process; ?>],
                backgroundColor: [
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(255, 99, 132, 0.2)'
                ],
                borderColor: [
                    'rgba(75, 192, 192, 1)',
                    'rgba(255, 99, 132, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Статусы заказов'
                }
            }
        }
    });

    // Столбчатая диаграмма - Количество заказов по пользователям
    const usernames = <?php echo json_encode($usernames); ?>;
    const orderCounts = <?php echo json_encode($order_counts); ?>;

    const ctxBar = document.getElementById('userOrdersChart').getContext('2d');
    const userOrdersChart = new Chart(ctxBar, {
        type: 'bar',
        data: {
            labels: usernames,
            datasets: [{
                label: 'Количество заказов',
                data: orderCounts,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                legend: {
                    display: false
                },
                title: {
                    display: true,
                    text: 'Количество заказов по пользователям'
                }
            }
        }
    });
    </script>
</body>
</html>

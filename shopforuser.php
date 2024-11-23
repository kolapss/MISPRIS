<?php 
session_start();
require 'includes/functions.php';
include("connection.php");
require_once('includes/showMessage.php');
displaySessionMessage();

// Проверка на авторизацию
if (isset($_SESSION['user_type'])) {
    include("navOptions/customer-dashboard-nav-options.php");
} else {
    include("navOptions/index-nav-options.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Магазин</title>
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/general.css">
</head>
<body>
    <nav>
        <a class="logo" href="index.php"><img src="images/Easyfly.png" alt="site-logo"></a>
        <?php include('navOptions/nav.php'); ?>
    </nav>

    <div class="container mt-5">
        <h2 style="text-align: center;">Каталог товаров</h2>

        <!-- Search -->
        <div class="d-flex justify-content-center mb-4">
            <input type="text" id="search" class="form-control w-50" placeholder="Поиск товара">
        </div>

        <!-- Items Table -->
        <table class="table table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Изображение</th>
                    <th>Название</th>
                    <th>Цена</th>
                    <th>Описание</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Fetch data from database
                $sql = "SELECT * FROM shop";
                $result = $con->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td><img src='uploads/" . htmlspecialchars($row['image']) . "' class='logo-img' alt='item-image'></td>";
                        echo "<td>" . htmlspecialchars($row['item_name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['price']) . " ₽</td>";
                        echo "<td>" . htmlspecialchars($row['description']) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4' class='text-center'><h3>Товаров пока нет</h3></td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <footer>
        <ul>
            <li><a href="index.php">Домой</a></li>
            <li><a href="aboutUs.php">О нас</a></li>
            <li><a href="aboutUs.php#targeting-contact">Контакты</a></li>
            <li><a href="booking-form.php">Сервисы</a></li>
        </ul>
        <p>&copy 2024 МойФутбол, все права защищены</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script>
        // Search Filter
        $('#search').on('keyup', function () {
            var value = $(this).val().toLowerCase();
            $('tbody tr').filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
            });
        });
    </script>
</body>
</html>
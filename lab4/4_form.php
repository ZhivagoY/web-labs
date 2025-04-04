<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['pet_name'] = $_POST['pet_name'];
    $_SESSION['pet_type'] = $_POST['pet_type'];
    $_SESSION['pet_age'] = $_POST['pet_age'];
    header('Location: 4_display.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Данные о питомце</title>
</head>
<body>
    <h2>Введите информацию о вашем питомце</h2>
    <form action="4_display.php" method="post">
        <label>Имя питомца:</label>
        <input type="text" name="pet_name" required><br><br>
        
        <label>Вид животного:</label>
        <input type="text" name="pet_type" required><br><br>
        
        <label>Возраст (лет):</label>
        <input type="number" name="pet_age" min="0" max="50" required><br><br>
        
        <button type="submit">Сохранить</button>
    </form>
</body>
</html>
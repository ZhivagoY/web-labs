<?php
session_start();

if (!isset($_SESSION['pet_name'])) {
    header('Location: 4_form.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Информация о питомце</title>
</head>
<body>
    <h2>Данные о вашем питомце:</h2>
    
    <?php if (isset($_SESSION['pet_name'])): ?>
        <p><strong>Имя:</strong> <?= $_SESSION['pet_name'] ?></p>
        <p><strong>Вид:</strong> <?= $_SESSION['pet_type'] ?></p>
        <p><strong>Возраст:</strong> <?= $_SESSION['pet_age'] ?> лет</p>
    <?php else: ?>
        <p>Данные не введены. <a href="4_form.php">Вернитесь к форме</a></p>
    <?php endif; ?>
</body>
</html>
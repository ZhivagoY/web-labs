<?php
//Подключение к серверу MySQL
$mysqli = new mysqli('db', 'root', 'helloworld', 'web');

if (mysqli_connect_errno()) {
    printf("Подключение к серверу MySQL невозможно. Код ошибки: %s\n", mysqli_connect_error());
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $mysqli->real_escape_string($_POST['email']);
    $title = $mysqli->real_escape_string($_POST['title']);
    $category = $mysqli->real_escape_string($_POST['category']);
    $description = $mysqli->real_escape_string($_POST['description']);

    $query = "INSERT INTO ad (email, title, description, category) VALUES ('$email', '$title', '$description', '$category')";
    $mysqli->query($query);
}

//Запрос к серверу
$advertisements = [];
if ($result = $mysqli->query('SELECT * FROM ad ORDER BY created DESC')) {
    //Выбор результата
    while ($row = $result->fetch_assoc()) {
        $advertisements[] = $row;
    }
    $result->close();
}

//Закрываем соединение
$mysqli->close();
?>



<!DOCTYPE html>
<head>
    <title>Lab 7</title>
</head>
<body>
    <form method="post">
        Mail: <input type="email" name="email"><br>
        Title: <input type="text" name="title"><br>
        Category:
        <select name="category">
            <option>Арбуз</option>
            <option>Виноград</option>
            <option>Дыня</option>
        </select><br>
        Discription: <label><textarea name="description"></textarea></label><br>
        <button>Send</button>
    </form>
    <h3>Advertisements:</h3>
    <table>
    <tr>
        <td><b>Mail</b></td>
        <td><b>Title</b></td>
        <td><b>Category</b></td>
        <td><b>Discription</b></td>
    </tr>
    <?php foreach ($advertisements as $i): ?>
        <tr>
            <td><?=$i['email']?></td>
            <td><?=$i['title']?></td>
            <td><?=$i['description']?></td>
            <td><?=$i['category']?></td>
        </tr>
    <?php endforeach; ?>
    </table>
</body>
</html>
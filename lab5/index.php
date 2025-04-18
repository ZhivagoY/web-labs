<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $category = $_POST["category"];
    $title = preg_replace("/[^a-zA-Zа-яА-Я0-9_\s]/u", "", $_POST["title"]);
    $content = $_POST["content"];
    
    if (!empty($email) && !empty($category) && !empty($title) && !empty($content)) {
        $filename = "$category/" . str_replace(" ", "_", $title) . ".txt";
        file_put_contents($filename, "Email: $email\n$content");
    }
}

$ads = [];
$categories = ["Инструменты", "Ремонт", "Строительство"];
foreach ($categories as $cat) {
    $files = glob("$cat/*.txt");
    foreach ($files as $file) {
        $content = file_get_contents($file);
        $ads[] = [
            "category" => $cat,
            "title" => pathinfo($file, PATHINFO_FILENAME),
            "content" => $content
        ];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Доска объявлений</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="form-container">
        <div>
            <h1 class="form-title">Добавьте объявление</h1>
            <form action="#" method="post">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" class="form-control" name="email" required>
                </div>

                <div class="form-group">
                    <label for="category">Категория:</label>
                    <div class="select-wrapper">
                        <select name="category" id="country" class="select-control" required>
                            <option value="" disabled selected>Выберите категорию</option>
                            <option value="Инструменты">Инструменты</option>
                            <option value="Ремонт">Ремонт</option>
                            <option value="Строительство">Строительство</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="title">Заголовок:</label>
                    <input type="text" class="form-control" name="title" required>
                </div>

                <div class="form-group">
                    <label for="content">Текст объявления:</label>
                    <textarea name="content" class="form-control" required></textarea>
                </div>

                <button type="submit" class="btn">Добавить объявление</button>
            </form>
        </div>
    </div>
</body>
</html>
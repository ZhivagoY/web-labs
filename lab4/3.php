<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Подсчёт слов на согласные</title>
</head>
<body>
    <form method="post">
        <textarea name="text" rows="5" cols="50"></textarea><br>
        <button type="submit">Посчитать</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $text = $_POST['text'] ?? '';
        
        if (!empty($text)) {
            // Разбиваем текст на слова
            $words = preg_split('/\s+/u', $text, -1, PREG_SPLIT_NO_EMPTY);
            
            // Согласные буквы (русские и английские)
            $consonantRegex = '/^[bcdfghjklmnpqrstvwxyzбвгджзйклмнпрстфхцчшщ]/iu';
            
            $count = 0;
            foreach ($words as $word) {
                if (preg_match($consonantRegex, $word)) {
                    $count++;
                }
            }
            
            echo "<p>Количество слов, начинающихся с согласной: $count</p>";
        } else {
            echo "<p>Введите текст для анализа</p>";
        }
    }
    ?>
</body>
</html>
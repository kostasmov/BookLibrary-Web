<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Изменение статуса книги</title>
</head>
<body>
    <p>Уважаемый {{ $reader->first_name }} {{ $reader->last_name }},</p>

    <p>Информируем вас, что статус книги <strong>{{ $book->title }}</strong> был изменён. Текущий статус: <strong>{{ $statusMessage }}</strong>.</p>

    <p>Спасибо за использование нашей библиотеки!</p>
</body>
</html>

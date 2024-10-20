@extends('layouts.app')

@section('title', 'О библиотеке')

@section('content')
<div class="section">
    <style>
        .steps-list {
            margin: 20px 0;
            padding-left: 20px;
            list-style-type: decimal;
        }

        .steps-list li {
            margin-bottom: 10px;
            line-height: 1.5;
        }
    </style>
    <h1>О нашей библиотеке</h1>
    <p>
        Доброго времени суток! Этот сайт создан для того, чтобы ты мог из любой точки мира, где есть доступ в
        интернет, забронировать желаемую книгу (если ты, конечно, будешь её брать):
    </p>
    <br>

    <h2>Шаги для получения книги</h2>
    <ol class="steps-list">
        <li>Для начала ты приходишь к нам, и администратор тебя регистрирует в нашей базе данных, выдаёт пароль ^_^</li>
        <li>Затем ты можешь войти в свой аккаунт, поменять пароль и остальную информацию.</li>
        <li>На вкладке "Библиотека" выбираешь в каталоге желаемую книгу.</li>
        <li>Если она ещё никем не занята, а у тебя нет задолженностей - нажимаешь на кнопку "Взять на дом".</li>
        <li>Затем ты приходишь по нашему адресу и берёшь книгу, после чего таймер твоего возврата активируется!</li>
    </ol>

    <p>
        Кстати говоря, мы находимся здесь:
    </p>

    <!-- Скрипт для Яндекс.Карт -->
    <script type="text/javascript" charset="utf-8" async
        src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A668d851bcb0b58a185ac228d60bd83160884f8720118e15649080caa82f4c40a&amp;width=678&amp;height=410&amp;lang=ru_RU&amp;scroll=true"></script>

    <p>
        И ещё: работаем с 9:00 до 18:00, так что если ты имеешь работу в офисе, то желаем удачи успеть добраться до нас
        в час-пик!
    </p>
</div>
@endsection
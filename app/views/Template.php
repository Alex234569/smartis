<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset='utf-8'>
    <title>Чатики</title>
    <link href='../../js/style.css' rel='stylesheet'>
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src = "https://code.highcharts.com/highcharts.js"></script>
    <script src="../../js/script.js"></script>
</head>

<body>

    <div>
        <p id='boldText'>Введите 2 даты для создания диапозона, или же одну для поиска по конкретному числу:</p>
        <form action='' id='whatTime' method ='POST'></form>
        <label><input type="date" form='whatTime' name='dateOne'></label>
        <label><input type="date" form='whatTime' name='dateTwo'></label><br />
        <input type='submit' value='Тыкалка' form='whatTime' name='buttonTime'>
    </div>
</body>
</html>




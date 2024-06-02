<?php
ob_start();
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Майстерня Прикрас</title>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css"/>
    <link rel="stylesheet" href="/css/about.css">
</head>
<body>
<header>
    <div class="slick-slider">
        <div><img src="about_1.jpg" alt="Image 1"></div>
        <div><img src="about_2.jpg" alt="Image 2"></div>
        <div><img src="about_3.jpg" alt="Image 3"></div>
    </div>
</header>

<div class="greeting">
    <h1>Вітаємо в нашій Майстерні Прикрас!</h1>
    <p>Наші прикраси створюються з любов'ю і увагою до деталей. Ми прагнемо зробити кожен ваш день особливим.</p>
</div>

<div class="introduction">
    <p>Майстерня Прикрас - це місце, де ваші мрії стають реальністю. <br>
        Ми пропонуємо широкий асортимент прикрас, які підходять для будь-якої події.</p>
    <img src="logo.png" alt="Introduction Image" class="intro-img">
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
<script src="/js/about.js"></script>

</body>
</html>

<?php
$this->Content = ob_get_clean();
?>

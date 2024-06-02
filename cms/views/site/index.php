<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cover Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css"/>
    <style>
        body, html {
            height: 100%;
            margin: 0;
            color: #333;
            background: #f5f5f5;
            font-family: Arial, sans-serif;
        }
        .cover-container {
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            background: #AEC09A;
            color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            margin-top: 50px;
        }
        .cover-container h1 {
            font-size: 2.5em;
            margin: 0.4em 0;
        }
        .cover-container p {
            background: rgba(255, 255, 255, 0.2);
            padding: 15px;
            border-radius: 8px;
            margin: 0.4em 0;
            margin-bottom: 24px;
        }
        .cover-container .btn-primary {
            background: #ff6f61;
            border-color: #ff6f61;
            padding: 10px 20px;
            font-size: 1.2em;
            margin-top: 1em;
        }
        .nav {
            background: none;
        }
        .nav-link {
            color: #fff;
        }

        a{
            color: #333;
        }

        .stones_link {
            color: #fff;
            background-color: #344C11;
            padding: 12px 8px;
            border-radius: 6px;
            text-decoration: none;
            margin-top: 5px;
        }

        .main_text {
            width: 100%;
            max-width: 600px;
        }

        @media (max-width: 768px) {
            .cover-container {
                padding: 15px;
                margin-top: 20px;
            }
            .cover-container h1 {
                font-size: 2em;
            }
            .cover-container p {
                font-size: 1em;
                padding: 10px;
            }
            .cover-container .btn-primary {
                font-size: 1em;
                padding: 8px 16px;
            }
        }
        @media (max-width: 576px) {
            .cover-container h1 {
                font-size: 1.5em;
            }
            .cover-container p {
                font-size: 0.9em;
                padding: 8px;
            }
            .cover-container .btn-primary {
                font-size: 0.9em;
                padding: 6px 12px;
            }
        }
    </style>
</head>
<body>


<div class="header-slider">
    <div>
        <img src="back.jpg" alt="Header Image 1" class="header-image">
    </div>
    <div>
        <img src="back_1.jpg" alt="Header Image 2" class="header-image">
    </div>
    <div>
        <img src="back_2.jpg" alt="Header Image 3" class="header-image">
    </div>
</div>

<div class="cover-container">
    <h1>Сайт - побудований у вигляді каталогу</h1>
    <p class="main_text">Для замовлення Вам потрібно <br>
        підібрати форму прикраси - з відповідного розділу видів прикрас - та камінь з Каталогу каменів .<br>
        Зателефонувати за номером <span style="color: #051b11; font-weight: bold">+380 (99) 48 78 049</span> щоб менеджер оформив ваше замовлення.
    </p>

    <p class="main_text">І все - прикраса буде створена за 1 день! У будь-якому випадку - менеджер напише Вам для уточнення деталей.</p>
    <button class="nav-link px-2 link-body-emphasis"><a href="/stones" class="stones_link">Каталог каменів</a></button>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
<script>
    $(document).ready(function(){
        $('.header-slider').slick({
            autoplay: true,
            autoplaySpeed: 2000,
        });
    });
</script>

</body>
</html>

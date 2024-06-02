<?php
/** @var string $Title */
/** @var string $Content */
if (empty($Title))
    $Title = '';

if (empty($Content))
    $Content = '';
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $Title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"/>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
    <style>
        footer {
            background-color: #f8f9fa;
            color: #343a40;
            padding: 40px 0;
        }
        footer .nav-link {
            color: #343a40;
        }
        footer .social-icons a {
            color: #343a40;
            margin: 0 10px;
            font-size: 24px;
        }
        footer .contact-info p {
            margin: 0;
        }
        .header-image {
            width: 100%;
            height: 400px;
            object-fit: cover;
            display: block;
            border-radius: 4px;
        }
        .navigation {
            background-color: #fff;
            padding: 10px 0;
        }
        .navigation a {
            font-weight: bold;
        }
        .navigation a:hover {
            text-decoration: underline;
        }

        .text-decoration-none{
            color: #333;
        }

        .navigation .logo {
            margin: 0 20px;
        }

        .navigation .logo img {
            height: 50px;
        }
        .navigation .menu-left,
        .navigation .menu-right {
            display: flex;
            align-items: center;
        }
        .navigation .menu-left {
            margin-right: auto;
        }

        .navigation .menu-right {
            margin-left: auto;
        }

    </style>
</head>
<body>
<div class="container">
    <header class="p-3 mb-3 border-bottom">
        <div class="container navigation">
            <div class="d-flex align-items-center justify-content-between">
                <div class="logo">
                    <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 link-body-emphasis text-decoration-none">
                        <img src="/logo.png" alt="Логотип">
                    </a>
                </div>

                <div class="menu-links">
                    <ul class="nav mb-2 mb-md-0">
                        <li><a href="/" class="nav-link px-2 link-secondary">Головна</a></li>
                        <li><a href="/products" class="nav-link px-2 link-body-emphasis">Усі прикраси</a></li>
                        <li><a href="/categories" class="nav-link px-2 link-body-emphasis">Категорії</a></li>
                        <li><a href="/stones" class="nav-link px-2 link-body-emphasis">Каталог каменів</a></li>
                        <li><a href="/about" class="nav-link px-2 link-body-emphasis">Про нас</a></li>
                    </ul>
                </div>

                <div class="user-menu">
                    <?php if(!\models\Users::IsUserLogged()) : ?>
                        <a href="/users/login" class="nav-link px-2 link-body-emphasis"><img src="lock.png" alt=""></a>
                    <?php endif; ?>
                    <?php if(\models\Users::IsUserLogged()) : ?>
                        <div class="dropdown text-end">
                            <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle"
                               data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle">
                            </a>

                            <ul class="dropdown-menu text-small">
                                <li><a class="dropdown-item" href="/users/logout">Вийти</a></li>
                            </ul>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </header>

    <div>
        <h1><?=$Title?></h1>
        <?= $Content?>
    </div>

    <footer class="py-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4 text-center">
                    <h5>Контакти</h5>
                    <p>+380 (99) 48 78 049</p>
                    <p><a href="mailto:workshop.form.a@gmail.com" class="text-decoration-none">bijou@gmail.com</a></p>
                </div>
                <div class="col-md-4 text-center">
                    <h5>Години роботи</h5>
                    <p>Прийом замовлень: на сайті цілодобово</p>
                    <p>Опрацювання замовлень: 10:00-17:00</p>
                    <p>Виготовлення: Пн-Сб 10:00 - 17:00</p>
                </div>
                <div class="col-md-4 text-center">
                    <h5>Розділи сайту</h5>
                    <p><a href="/stones" class="text-decoration-none">Каталог каменів</a></p>
                    <p><a href="/about" class="text-decoration-none">Про нас</a></p>
                    <p><a href="#" class="text-decoration-none">Умови роботи</a></p>
                </div>
            </div>
            <div class="d-flex justify-content-center social-icons mt-3">
                <a href="#"><img src="/inst.png" alt="Instagram" width="24" height="24"></a>
                <a href="#"><img src="/facebook.png" alt="Facebook" width="24" height="24"></a>
                <a href="#"><img src="/telegram.png" alt="Etsy" width="24" height="24"></a>
            </div>
            <p class="text-center mt-3">© 2024 Oleksandra Friz</p>
        </div>
    </footer>
</div>

</body>
</html>

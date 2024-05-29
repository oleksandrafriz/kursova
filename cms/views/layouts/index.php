<?php
/** @var string $Title */
/** @var string $Content */
if(empty($Title))
    $Title = '';

if(empty($Content))
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
</head>
<body>
<div class="container">
    <header class="p-3 mb-3 border-bottom">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 link-body-emphasis text-decoration-none">
                    <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap">
                        <use xlink:href="#bootstrap"></use>
                    </svg>
                </a>

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <li><a href="/" class="nav-link px-2 link-secondary">Головна</a></li>
                    <li><a href="/products" class="nav-link px-2 link-body-emphasis">Усі прикраси</a></li>
                    <li><a href="/categories" class="nav-link px-2 link-body-emphasis">Категорії</a></li>
                    <li><a href="/stones" class="nav-link px-2 link-body-emphasis">Каталог каменів</a></li>
                    <?php if(!\models\Users::IsUserLogged()) : ?>
                    <li><a href="/users/login" class="nav-link px-2 link-body-emphasis">Увійти</a></li>
<!--                        <li><a href="/users/register" class="nav-link px-2 link-body-emphasis">Зареєструватись</a></li>-->
                    <?php endif; ?>
                </ul>

                <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
                    <input type="search" class="form-control" placeholder="Search..." aria-label="Search">
                </form>
                <?php if(\models\Users::IsUserLogged()) : ?>
                <div class="dropdown text-end">
                    <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle">
                    </a>

                    <ul class="dropdown-menu text-small">
                        <li><a class="dropdown-item" href="#">New project...</a></li>
                        <li><a class="dropdown-item" href="#">Settings</a></li>
                        <li><a class="dropdown-item" href="#">Profile</a></li>
<!--                        <li>-->
<!--                            <hr class="dropdown-divider">-->
<!--                        </li>-->
                        <li><a class="dropdown-item" href="/users/logout">Вийти</a></li>
                    </ul>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <div>
        <h1><?=$Title?></h1>
        <?= $Content?>
    </div>

    <footer class="py-3 my-4">
        <ul class="nav justify-content-center border-bottom pb-3 mb-3">
            <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Головна</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Каталог каменів</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Про нас</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Умови роботи</a></li>
        </ul>
        <p class="text-center text-body-secondary">© 2024 Company, Inc</p>
        <div class="d-flex justify-content-center">
            <a href="#" class="text-body-secondary mx-2"><img src="instagram_icon.png" alt="Instagram"></a>
            <a href="#" class="text-body-secondary mx-2"><img src="facebook_icon.png" alt="Facebook"></a>
            <a href="#" class="text-body-secondary mx-2"><img src="etsy_icon.png" alt="Etsy"></a>
        </div>
        <div class="text-center text-body-secondary mt-3">
            <p>Контакти: +380 (99) 48 78 049 | workshop.form.a@gmail.com</p>
            <p>Години роботи: Прийом замовлень: на сайті цілодобово | Обробка замовлень: 10:00-17:00 | Виготовлення: Пн-Сб 10:00 - 17:00</p>
        </div>
    </footer>
</div>

</body>
</html>
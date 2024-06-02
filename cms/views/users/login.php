<?php
$this->Title = 'Вхід на сайт';
/** @var string $error_message  Повідомлення про помилку*/
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($this->Title) ?></title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body, html {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
        }
        .main-content {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .form-container {
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
        }
        .form-label {
            font-weight: bold;
        }
        .form-control {
            padding: 10px;
            font-size: 1rem;
        }
        .btn-primary {
            background-color: #344C11;
            border-color: #344C11;
        }
        .btn-primary:hover {
            background-color: #2c3a0e;
            border-color: #2c3a0e;
        }

        h1{
            text-align: center;
        }
    </style>
</head>
<body>

<div class="header">
</div>

<div class="main-content">
    <div class="form-container">
        <form method="post" action="">
            <?php if (!empty($error_message)) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= htmlspecialchars($error_message) ?>
                </div>
            <?php endif; ?>
            <div class="mb-3">
                <label for="inputEmail" class="form-label">Логін/email</label>
                <input name="login" type="email" class="form-control" id="inputEmail" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="inputPassword" class="form-label">Пароль</label>
                <input name="password" type="password" class="form-control" id="inputPassword">
            </div>
            <button type="submit" class="btn btn-primary w-100">Увійти</button>
        </form>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

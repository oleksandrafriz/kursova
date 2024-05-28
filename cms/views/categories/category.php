<?php
/** @var array $category */
/** @var array $products */
$this->Title = 'Список товарів';
ob_start();
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Список товарів</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            color: #333;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #0066cc;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .col {
            flex: 1 1 calc(33.333% - 20px);
            max-width: calc(33.333% - 20px);
        }

        .card {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            overflow: hidden;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }

        .card-link {
            text-decoration: none;
            color: inherit;
        }

        .card-img-top {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .card-body {
            padding: 15px;
        }

        .card-title {
            font-size: 1.25em;
            margin-bottom: 10px;
            color: #333;
        }

        .card-text {
            font-size: 1em;
            color: #777;
        }

        .card-text.price {
            font-size: 1.2em;
            color: #d9534f;
            font-weight: bold;
        }

        .card-text span {
            color: #333;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <?php foreach ($products as $product): ?>
            <div class="col">
                <div class="card h-100">
                    <a href="/products/product/<?= htmlspecialchars($product['id'] ?? '') ?>" class="card-link">
                        <img src="https://via.placeholder.com/300x200?text=<?= isset($product['name']) ? urlencode($product['name']) : '' ?>" alt="<?= htmlspecialchars($product['name'] ?? '') ?>" class="card-img-top">
                        <div class="card-body">
                            <h2 class="card-title"><?= htmlspecialchars($product['name'] ?? 'Unnamed Product') ?></h2>
                            <p class="card-text price"><span>Price:</span> <?= htmlspecialchars($product['price'] ?? 'N/A') ?> UAH</p>
                        </div>
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
</body>
</html>
<?php
$this->Content = ob_get_clean();
?>

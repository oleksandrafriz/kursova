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
            color: #344c11;
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
            color: #97b882;
            font-weight: bold;
        }

        .card-text span {
            color: #333;
        }

        .sort-btns {
            margin-bottom: 20px;
            display: flex;
            gap: 10px;
            justify-content: center;
        }
        .sort-btn {
            background-color: #778D45;
            color: #fff;
            border: none;
            padding: 5px 15px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .sort-group {
            margin-bottom: 20px;
        }

    </style>
</head>
<body>
<div class="container">
    <div class="sort-btns">
        <div class="sort-group">
            <button class="sort-btn" onclick="sortProducts('price', 'ASC')">Сортувати за зростанням ціни</button>
            <button class="sort-btn" onclick="sortProducts('price', 'DESC')">Сортувати за спаданням ціни</button>
        </div>
        <div class="sort-group">
            <button class="sort-btn" onclick="sortProducts('name', 'ASC')">Сортувати від А до Я</button>
            <button class="sort-btn" onclick="sortProducts('name', 'DESC')">Сортувати від Я до А</button>
        </div>
    </div>
    <div class="row" id="products-container">
        <?php foreach ($products as $product): ?>
            <div class="col product-card" data-price="<?= htmlspecialchars($product['price']) ?>" data-name="<?= htmlspecialchars($product['name']) ?>">
                <div class="card h-100">
                    <a href="/products/product/<?= htmlspecialchars($product['id'] ?? '') ?>" class="card-link">
                        <img src="<?= isset($product['image']) ? htmlspecialchars($product['image']) : 'https://via.placeholder.com/300x200?text=' . (isset($product['name']) ? urlencode($product['name']) : '') ?>" alt="<?= htmlspecialchars($product['name'] ?? '') ?>" class="card-img-top">
                        <div class="card-body">
                            <h2 class="card-title"><?= htmlspecialchars($product['name'] ?? 'Unnamed Product') ?></h2>
                            <p class="card-text price"> <?= htmlspecialchars($product['price'] ?? 'N/A') ?> UAH</p>
                        </div>
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<script>
    function sortProducts(field, direction) {
        const container = document.getElementById('products-container');
        const products = Array.from(container.getElementsByClassName('product-card'));

        products.sort((a, b) => {
            let aValue = a.dataset[field];
            let bValue = b.dataset[field];

            if (field === 'price') {
                aValue = parseFloat(aValue);
                bValue = parseFloat(bValue);
            } else if (field === 'name') {
                aValue = aValue.toLowerCase();
                bValue = bValue.toLowerCase();
            }

            if (aValue < bValue) {
                return direction === 'ASC' ? -1 : 1;
            }
            if (aValue > bValue) {
                return direction === 'ASC' ? 1 : -1;
            }
            return 0;
        });

        container.innerHTML = '';
        products.forEach(product => container.appendChild(product));
    }
</script>
</body>
</html>
<?php
$this->Content = ob_get_clean();
?>

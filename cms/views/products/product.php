<?php
/** @var array $product */
$this->Title = htmlspecialchars($product['name'] ?? 'Product');
ob_start();
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($product['name'] ?? 'Product') ?></title>
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
        .product {
            display: flex;
            gap: 20px;
            align-items: flex-start;
        }
        .product-img {
            width: 100%;
            height: auto;
            max-width: 400px;
        }
        .product-details {
            flex: 1;
        }
        .product-price {
            font-size: 1.5em;
            color: #d9534f;
            margin-bottom: 10px;
            padding: 10px;
            border: 2px solid #d9534f;
            border-radius: 5px;
            background-color: #fff3f3;
            text-align: center;
        }
        .product-details table {
            width: 100%;
            border-collapse: collapse;
        }
        .product-details th, .product-details td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        .product-details th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="product">
        <img src="data:image/jpeg;base64,<?= htmlspecialchars($product['image'] ?? '') ?>" alt="<?= htmlspecialchars($product['name'] ?? 'Product') ?>" class="product-img">
        <div class="product-details">
            <div class="product-price"><strong>Price:</strong> <?= htmlspecialchars($product['price'] ?? '~') ?> UAH</div>
            <table>
                <tr>
                    <th>Characteristic</th>
                    <th>Value</th>
                </tr>
                <tr>
                    <td><strong>Color:</strong></td>
                    <td><?= htmlspecialchars($product['color'] ?? '~') ?></td>
                </tr>
                <tr>
                    <td><strong>Material:</strong></td>
                    <td><?= htmlspecialchars($product['material'] ?? '~') ?></td>
                </tr>
                <tr>
                    <td><strong>Size:</strong></td>
                    <td><?= htmlspecialchars($product['size'] ?? '~') ?></td>
                </tr>
                <tr>
                    <td><strong>Code:</strong></td>
                    <td><?= htmlspecialchars($product['code'] ?? '~') ?></td>
                </tr>
                <tr>
                    <td><strong>Metal:</strong></td>
                    <td><?= htmlspecialchars($product['metal'] ?? '~') ?></td>
                </tr>
                <tr>
                    <td><strong>Stone Size:</strong></td>
                    <td><?= htmlspecialchars($product['stone_size'] ?? '~') ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
</body>
</html>
<?php
$this->Content = ob_get_clean();
?>

<?php
/** @var array $product */
/** @var bool $isAdmin */
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
            color: #344C11;
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
            font-size: 2em;
            /* font-weight: bold; */
            color: #426044;
            margin-bottom: 10px;
            padding: 15px;
            border-radius: 5px;
            background-color: #c2ddc1;
            text-align: center;
            display: flex;
            /* justify-content: center; */
            align-items: center;
            /* background-color: #0056b3; */
            width: 145px;
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

        /*.edit-btn:hover {*/
        /*    background-color: #0056b3;*/
        /*}*/
        .form-control {
            margin-bottom: 10px;
        }
    </style>

    <!-- jQuery -->
    <script src="/js/jquery-3.7.1.js"></script>
    <!-- Bootstrap CSS -->
    <link href="/bootstrab/bootstrap-5.3.3-dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap JS -->
    <script src="/bootstrab/bootstrap-5.3.3-dist/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <h1>
        <span id="name-value"><?= htmlspecialchars($product['name'] ?? 'Product') ?></span>
    </h1>
    <div class="product">
        <img src="data:image/jpeg;base64,<?= htmlspecialchars($product['image'] ?? '') ?>" alt="<?= htmlspecialchars($product['name'] ?? 'Product') ?>" class="product-img" id="product-img">
        <div class="product-details">


            <div class="product-price">
                <span id="price-value"><?= htmlspecialchars($product['price'] ?? '~') ?></span> UAH
            </div>
            <table>
                <tr>
                    <th>Characteristic</th>
                    <th>Value</th>
                </tr>
                <tr>
                    <td><strong>Color:</strong></td>
                    <td id="color-value"><?= htmlspecialchars($product['color'] ?? '~') ?></td>
                </tr>
                <tr>
                    <td><strong>Material:</strong></td>
                    <td id="material-value"><?= htmlspecialchars($product['material'] ?? '~') ?></td>
                </tr>
                <tr>
                    <td><strong>Size:</strong></td>
                    <td id="size-value"><?= htmlspecialchars($product['size'] ?? '~') ?></td>
                </tr>
                <tr>
                    <td><strong>Code:</strong></td>
                    <td id="code-value"><?= htmlspecialchars($product['code'] ?? '~') ?></td>
                </tr>
                <tr>
                    <td><strong>Metal:</strong></td>
                    <td id="metal-value"><?= htmlspecialchars($product['metal'] ?? '~') ?></td>
                </tr>
                <tr>
                    <td><strong>Stone Size:</strong></td>
                    <td id="stone_size-value"><?= htmlspecialchars($product['stone_size'] ?? '~') ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>

<?php if ($isAdmin): ?>
    <div id="edit-product-form">
        <h3>Редагувати товар</h3>
        <form id="editProductForm" enctype="multipart/form-data">
            <input type="hidden" id="edit-id" name="id" value="<?= htmlspecialchars($product['id']) ?>">
            <div class="form-group">
                <label for="edit-name">Назва товару</label>
                <input type="text" class="form-control" id="edit-name" name="name" value="<?= htmlspecialchars($product['name']) ?>">
            </div>
            <div class="form-group">
                <label for="edit-price">Ціна</label>
                <input type="text" class="form-control" id="edit-price" name="price" value="<?= htmlspecialchars($product['price']) ?>">
            </div>
            <div class="form-group">
                <label for="edit-color">Колір</label>
                <input type="text" class="form-control" id="edit-color" name="color" value="<?= htmlspecialchars($product['color']) ?>">
            </div>
            <div class="form-group">
                <label for="edit-material">Матеріал</label>
                <input type="text" class="form-control" id="edit-material" name="material" value="<?= htmlspecialchars($product['material']) ?>">
            </div>
            <div class="form-group">
                <label for="edit-size">Розмір</label>
                <input type="text" class="form-control" id="edit-size" name="size" value="<?= htmlspecialchars($product['size']) ?>">
            </div>
            <div class="form-group">
                <label for="edit-code">Код</label>
                <input type="text" class="form-control" id="edit-code" name="code" value="<?= htmlspecialchars($product['code']) ?>">
            </div>
            <div class="form-group">
                <label for="edit-metal">Метал</label>
                <input type="text" class="form-control" id="edit-metal" name="metal" value="<?= htmlspecialchars($product['metal']) ?>">
            </div>
            <div class="form-group">
                <label for="edit-stone_size">Розмір каменю</label>
                <input type="text" class="form-control" id="edit-stone_size" name="stone_size" value="<?= htmlspecialchars($product['stone_size']) ?>">
            </div>
            <div class="form-group">
                <label for="edit-image">Зображення</label>
                <input type="file" class="form-control-file" id="edit-image" name="image">
            </div>
            <button type="button" class="btn btn-primary" id="update-product-btn">Зберегти</button>
        </form>
    </div>
<?php endif; ?>

<script>
    $('#update-product-btn').on('click', function() {
        var formData = new FormData($('#editProductForm')[0]);

        $.ajax({
            url: '/products/updateProduct',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    // Оновлення значень на сторінці
                    $('#name-value').text(response.product.name);
                    $('#price-value').text(response.product.price);
                    $('#color-value').text(response.product.color);
                    $('#material-value').text(response.product.material);
                    $('#size-value').text(response.product.size);
                    $('#code-value').text(response.product.code);
                    $('#metal-value').text(response.product.metal);
                    $('#stone_size-value').text(response.product.stone_size);

                    // Завжди оновлювати зображення
                    var imageData = response.product.image || ''; // Використовувати порожній рядок, якщо даних зображення немає
                    $('#product-img').attr('src', 'data:image/jpeg;base64,' + imageData);

                    alert(response.message); // Відображення повідомлення про успіх
                } else {
                    console.error('Error updating product:', response.error);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX error status:', status);
                console.error('AJAX error text:', error);
                console.error('AJAX response text:', xhr.responseText);
            }
        });
    });
</script>
</body>
</html>
<?php
$this->Content = ob_get_clean();
?>

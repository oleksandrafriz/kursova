<?php
/** @var array $categories */
$this->Title = 'Список категорій';
?>
    <style>
        .card-img-top {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .btn-primary{
            background-color: #778D45;
            border-color: #778D45;
        }
    </style>

    <div class="container my-5">
        <?php if (!empty($categories)): ?>
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <?php foreach ($categories as $category): ?>
                    <div class="col">
                        <div class="card h-100">
                            <img src="<?= isset($category['image']) ? htmlspecialchars($category['image']) : 'https://via.placeholder.com/300x200?text=' . urlencode($category['name']) ?>" class="card-img-top" alt="<?= htmlspecialchars($category['name']) ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($category['name']) ?></h5>
                                <a href="/categories/category/<?= $category['id'] ?>" class="btn btn-primary">Переглянути</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="text-muted text-center">No categories available.</p>
        <?php endif; ?>
    </div>

<?php
$this->Content = ob_get_clean();
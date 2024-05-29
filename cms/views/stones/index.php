<?php
/** @var array $stones */
$this->Title = 'Каталог каменів';
ob_start();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Каталог каменів</title>
    <!-- Slick CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css"/>
    <!-- Bootstrap CSS (припускаємо, що використовується Bootstrap) -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        .modal-dialog {
            max-width: 80%;
        }
        .modal-content {
            background: none;
            border: none;
        }
        .slick-slide {
            outline: none;
        }
        .slick-prev, .slick-next {
            width: 50px;
            height: 50px;
            z-index: 1000;
        }
        .slick-prev:before, .slick-next:before {
            font-size: 50px;
        }
        .slick-prev {
            left: 10px;
        }
        .slick-next {
            right: 10px;
        }
        .card-img-top {
            transition: 0.3s ease;
        }
        .card-img-top:hover {
            filter: brightness(70%);
        }
        .close-modal {
            position: absolute;
            top: 10px;
            right: 10px;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 50%;
            padding: 5px;
            font-size: 24px;
            cursor: pointer;
            z-index: 1000;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            transition: background 0.3s, box-shadow 0.3s;
        }
        .close-modal:hover {
            background: rgba(255, 255, 255, 1);
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        }
        .modal-body {
            position: relative;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <?php foreach ($stones as $stone): ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <?php if (!empty($stone['image'])): ?>
                        <img src="data:image/jpeg;base64,<?= htmlspecialchars($stone['image']) ?>" class="card-img-top" alt="<?= htmlspecialchars($stone['name']) ?>" data-toggle="modal" data-target="#imageModal" data-slide-index="<?= $stone['id'] ?>">
                    <?php else: ?>
                        <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="<?= htmlspecialchars($stone['name']) ?>">
                    <?php endif; ?>
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($stone['name']) ?></h5>
                        <p class="card-text">Розмір: <?= htmlspecialchars($stone['size']) ?> мм</p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="close-modal" data-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </div>
                <div class="slider-for">
                    <?php foreach ($stones as $stone): ?>
                        <div class="d-flex justify-content-center">
                            <?php if (!empty($stone['image'])): ?>
                                <img src="data:image/jpeg;base64,<?= htmlspecialchars($stone['image']) ?>" class="img-fluid" alt="<?= htmlspecialchars($stone['name']) ?>">
                            <?php else: ?>
                                <img src="https://via.placeholder.com/300x200" class="img-fluid" alt="<?= htmlspecialchars($stone['name']) ?>">
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- jQuery (необхідний для Slick Slider) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Slick Slider JS -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
<!-- Bootstrap JS and dependencies (припускаємо, що використовується Bootstrap) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('.card-img-top').on('click', function(){
            var slideIndex = $(this).data('slide-index');
            $('#imageModal').on('shown.bs.modal', function () {
                $('.slider-for').slick('slickGoTo', slideIndex);
            });

            $('.slider-for').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: true,
                fade: true
            });
        });

        $('#imageModal').on('hidden.bs.modal', function () {
            $('.slider-for').slick('unslick');
        });
    });
</script>
</body>
</html>

<?php
$this->Content = ob_get_clean();
?>

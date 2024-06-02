<?php
/** @var array $stones */
/** @var bool $isAdmin */

ob_start();
?>
<!doctype html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Каталог каменів</title>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css"/>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
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
        .modal-body {
            position: relative;
        }
        .search-bar {
            margin-bottom: 20px;
            display: flex;
            justify-content: center;
        }
        .search-input {
            padding: 5px;
            font-size: 1em;
            border-radius: 4px;
            border: 1px solid #ccc;
            width: 100%;
            max-width: 400px;
        }
        .add-stone-btn {
            background-color: #344c11;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-bottom: 20px;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
        .btn-danger{
            background-color: #e88a84;
            border-color: #e88a84;
        }

        .btn-primary{
            background-color: #AEC670;
            border-color: #AEC670;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="search-bar">
        <input type="text" id="search-input" class="search-input" placeholder="Пошук..." oninput="searchStones()">
    </div>
    <?php if ($isAdmin): ?>
        <button class="add-stone-btn" onclick="showAddStoneForm()">Додати новий камінь</button>
    <?php endif; ?>
    <div class="row" id="stones-container">
        <?php foreach ($stones as $stone): ?>
            <div class="col-md-4 mb-4 stone-card" data-id="<?= htmlspecialchars($stone['id']) ?>" data-name="<?= htmlspecialchars($stone['name']) ?>">
                <div class="card">
                    <?php if (!empty($stone['image'])): ?>
                        <img src="data:image/jpeg;base64,<?= htmlspecialchars($stone['image']) ?>" class="card-img-top" alt="<?= htmlspecialchars($stone['name']) ?>" data-toggle="modal" data-target="#imageModal" data-slide-index="<?= $stone['id'] ?>">
                    <?php else: ?>
                        <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="<?= htmlspecialchars($stone['name']) ?>">
                    <?php endif; ?>
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($stone['name']) ?></h5>
                        <p class="card-text">Розмір: <?= htmlspecialchars($stone['size']) ?> мм</p>
                        <?php if ($isAdmin): ?>
                            <button class="btn btn-danger delete-stone" data-id="<?= htmlspecialchars($stone['id']) ?>">Видалити</button>
                            <button class="btn btn-primary edit-stone" data-toggle="modal" data-target="#editStoneModal" data-id="<?= htmlspecialchars($stone['id']) ?>" data-name="<?= htmlspecialchars($stone['name']) ?>" data-size="<?= htmlspecialchars($stone['size']) ?>">Редагувати</button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Modal for Adding Stone -->
<div id="addStoneModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addStoneModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addStoneModalLabel">Додати новий камінь</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addStoneForm" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="add-name">Назва</label>
                        <input type="text" class="form-control" id="add-name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="add-size">Розмір</label>
                        <input type="number" class="form-control" id="add-size" name="size" required>
                    </div>
                    <div class="form-group">
                        <label for="add-image">Зображення</label>
                        <input type="file" class="form-control" id="add-image" name="image" accept="image/*">
                    </div>
                    <button type="button" class="btn btn-primary" onclick="submitAddStoneForm()">Зберегти</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Editing Stone -->
<div id="editStoneModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="editStoneModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editStoneModalLabel">Редагувати камінь</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editStoneForm" method="post" enctype="multipart/form-data">
                    <input type="hidden" id="edit-id" name="id">
                    <div class="form-group">
                        <label for="edit-name">Назва</label>
                        <input type="text" class="form-control" id="edit-name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-size">Розмір</label>
                        <input type="number" class="form-control" id="edit-size" name="size" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-image">Зображення</label>
                        <input type="file" class="form-control" id="edit-image" name="image" accept="image/*">
                    </div>
                    <button type="button" class="btn btn-primary" onclick="submitEditStoneForm()">Зберегти</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Viewing Images -->
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
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

        $('.edit-stone').on('click', function() {
            var id = $(this).data('id');
            var name = $(this).data('name');
            var size = $(this).data('size');

            $('#edit-id').val(id);
            $('#edit-name').val(name);
            $('#edit-size').val(size);
        });

        $('.delete-stone').on('click', function() {
            var stoneId = $(this).data('id');
            if (confirm('Ви впевнені, що хочете видалити цей камінь?')) {
                deleteStone(stoneId);
            }
        });
    });

    function searchStones() {
        const input = document.getElementById('search-input').value.toLowerCase();
        const stones = document.getElementsByClassName('stone-card');

        Array.from(stones).forEach(stone => {
            const name = stone.dataset.name.toLowerCase();
            if (name.includes(input)) {
                stone.style.display = '';
            } else {
                stone.style.display = 'none';
            }
        });
    }

    function showAddStoneForm() {
        $('#addStoneModal').modal('show');
    }

    function submitAddStoneForm() {
        const form = document.getElementById('addStoneForm');
        const formData = new FormData(form);

        fetch('/stones/add', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    console.error('Error adding stone.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

    function submitEditStoneForm() {
        const form = document.getElementById('editStoneForm');
        const formData = new FormData(form);

        fetch('/stones/update', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const stoneId = data.stone.id;
                    const stoneCard = document.querySelector(`.stone-card[data-id="${stoneId}"]`);

                    stoneCard.querySelector('.card-title').textContent = data.stone.name;
                    stoneCard.querySelector('.card-text').textContent = `Розмір: ${data.stone.size} мм`;

                    if (data.stone.image) {
                        stoneCard.querySelector('.card-img-top').src = `data:image/jpeg;base64,${data.stone.image}`;
                    }

                    $('#editStoneModal').modal('hide');
                } else {
                    console.error('Error updating stone:', data.error);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

    function deleteStone(stoneId) {
        fetch('/stones/delete/' + stoneId, {
            method: 'DELETE'
        })
            .then(response => {
                if (response.ok) {
                    const stoneCard = document.querySelector(`.stone-card[data-id="${stoneId}"]`);
                    if (stoneCard) {
                        stoneCard.remove();
                    }
                } else {
                    console.error('Error deleting stone.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }
</script>
</body>
</html>

<?php
$this->Content = ob_get_clean();
?>

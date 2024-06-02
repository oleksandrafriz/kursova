<?php

namespace controllers;

use core\Controller;
use core\Core;
use models\Products;

class ProductsController extends Controller
{
    public function actionIndex()
    {
        $orderBy = isset($_GET['orderBy']) ? $_GET['orderBy'] : 'price';
        $orderDirection = isset($_GET['orderDirection']) ? $_GET['orderDirection'] : 'ASC';
        $minPrice = isset($_GET['minPrice']) ? (int)$_GET['minPrice'] : null;
        $maxPrice = isset($_GET['maxPrice']) ? (int)$_GET['maxPrice'] : null;

        $products = Products::getAllProducts($orderBy, $orderDirection, $minPrice, $maxPrice);
        $isAdmin = Core::get()->session->get('isAdmin', false);

        $this->render(['products' => $products, 'isAdmin' => $isAdmin]);
    }


    public function actionProduct($id)
    {
        if (is_array($id)) {
            $id = array_shift($id);
        }
        $id = (int)$id;

        $product = Products::getProductById($id);

        if (!$product) {
            $this->addErrorMessage('Product not found');
            $this->render([]);
            return;
        }

        $isAdmin = Core::get()->session->get('isAdmin', false);
        $this->render(['product' => $product, 'isAdmin' => $isAdmin]);
    }



    public function actionDelete($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
            $id = (int)$id;
            $result = Products::deleteProduct($id);
            if ($result) {
                http_response_code(204);
            } else {
                http_response_code(404);
            }
        } else {
            http_response_code(405);
        }
    }

    public function actionUpdateProduct()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;

            if (!$id) {
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'error' => 'Product ID is required.']);
                exit;
            }

            $product = Products::getProductById((int)$id);
            if (!$product) {
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'error' => 'Product not found.']);
                exit;
            }

            $name = $_POST['name'] ?? '';
            $price = $_POST['price'] ?? 0;
            $color = $_POST['color'] ?? '';
            $material = $_POST['material'] ?? '';
            $size = $_POST['size'] ?? 0;
            $code = $_POST['code'] ?? '';
            $metal = $_POST['metal'] ?? '';
            $stone_size = $_POST['stone_size'] ?? 0;
            $image = $_FILES['image'] ?? null;

            $fieldsToUpdate = [
                'name' => $name,
                'price' => $price,
                'color' => $color,
                'material' => $material,
                'size' => $size,
                'code' => $code,
                'metal' => $metal,
                'stone_size' => $stone_size
            ];

            if ($image && $image['error'] === UPLOAD_ERR_OK) {
                $uploadDir = 'uploads/';

                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0775, true);
                }

                $fileName = uniqid() . '_' . $image['name'];
                $filePath = $uploadDir . $fileName;

                if (move_uploaded_file($image['tmp_name'], $filePath)) {
                    $fieldsToUpdate['image'] = file_get_contents($filePath);
                } else {
                    header('Content-Type: application/json');
                    echo json_encode(['success' => false, 'error' => 'Failed to upload the image.']);
                    exit;
                }
            }

            $updated = Products::updateProduct((int)$id, $fieldsToUpdate);

            if ($updated) {
                $updatedProduct = Products::getProductById((int)$id);
                header('Content-Type: application/json');
                echo json_encode(['success' => true, 'message' => 'Product updated successfully!', 'product' => $updatedProduct]);
                exit;
            }

            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'error' => 'Failed to update the product.']);
            exit;
        }

        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'error' => 'Invalid request method']);
        exit;
    }



    public function actionAddProduct()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Логування даних з форми для відлагодження
            error_log(print_r($_POST, true));
            error_log(print_r($_FILES, true));

            $name = $_POST['name'] ?? '';
            $price = $_POST['price'] ?? 0;
            $color = $_POST['color'] ?? '';
            $material = $_POST['material'] ?? '';
            $size = $_POST['size'] ?? 0;
            $code = $_POST['code'] ?? '';
            $metal = $_POST['metal'] ?? '';
            $stone_size = $_POST['stone_size'] ?? 0;
            $category_id = $_POST['category_id'] ?? 1;
            $image = $_FILES['image'] ?? null;

            $product = new Products();
            $product->name = $name;
            $product->price = $price;
            $product->color = $color;
            $product->material = $material;
            $product->size = $size;
            $product->code = $code;
            $product->metal = $metal;
            $product->stone_size = $stone_size;
            $product->category_id = $category_id;

            if ($image && $image['error'] === UPLOAD_ERR_OK) {
                $uploadDir = 'uploads/';

                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0775, true);
                }

                $fileName = uniqid() . '_' . $image['name'];
                $filePath = $uploadDir . $fileName;

                if (move_uploaded_file($image['tmp_name'], $filePath)) {
                    $product->image = file_get_contents($filePath);
                } else {
                    $this->addErrorMessage('Не вдалося завантажити зображення.');
                    $this->render([]);
                    return;
                }
            }

            try {
                $product->save();
                $this->redirect('/products');
            } catch (\Exception $e) {
                error_log($e->getMessage());
                $this->addErrorMessage('Не вдалося додати товар до бази даних.');
                $this->render([]);
            }
        }

        $this->render([]);
    }

}

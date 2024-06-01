<?php

namespace controllers;

use core\Controller;
use core\Core;
use models\Products;
use models\Categories;

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


//    public function actionUpdate()
//    {
//        $id = $_POST['id'] ?? null;
//        $field = $_POST['field'] ?? null;
//        $value = $_POST['value'] ?? null;
//
//        header('Content-Type: application/json');
//
//        if ($id && $field && $value) {
//            $product = Products::getProductById((int)$id);
//            if ($product) {
//                $product[$field] = $value;
//                $updated = Products::updateProduct($id, [$field => $value]);
//
//                if ($updated) {
//                    echo json_encode(['success' => true, 'message' => 'Product updated successfully!']);
//                } else {
//                    echo json_encode(['success' => false, 'error' => 'Failed to update the product in the database.']);
//                }
//            } else {
//                echo json_encode(['success' => false, 'error' => 'Product not found.']);
//            }
//        } else {
//            echo json_encode(['success' => false, 'error' => 'Invalid input parameters.', 'id' => $id, 'field' => $field, 'value' => $value]);
//        }
//    }

    public function actionAddProduct()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Debugging: Log the received data
            error_log('Received POST data: ' . print_r($_POST, true));
            error_log('Received FILES data: ' . print_r($_FILES, true));

            $name = $_POST['name'] ?? '';
            $price = $_POST['price'] ?? 0;
            $color = $_POST['color'] ?? '';
            $material = $_POST['material'] ?? '';
            $size = $_POST['size'] ?? 0;
            $code = $_POST['code'] ?? '';
            $metal = $_POST['metal'] ?? '';
            $stone_size = $_POST['stone_size'] ?? 0;
            $image = $_FILES['image'] ?? null;

            $fieldsToInsert = [
                'name' => $name,
                'price' => $price,
                'color' => $color,
                'material' => $material,
                'size' => $size,
                'code' => $code,
                'metal' => $metal,
                'stone_size' => $stone_size
            ];

            error_log('Fields to insert: ' . print_r($fieldsToInsert, true));

            if ($image && $image['error'] === UPLOAD_ERR_OK) {
                $uploadDir = 'uploads/';

                // Check if the directory exists, if not, create it
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0775, true);
                }

                $fileName = uniqid() . '_' . $image['name'];
                $filePath = $uploadDir . $fileName;

                if (move_uploaded_file($image['tmp_name'], $filePath)) {
                    $fieldsToInsert['image'] = file_get_contents($filePath); // Store the raw image data
                    error_log('Image uploaded successfully: ' . $filePath);
                } else {
                    error_log('Failed to upload the image.');
                    header('Content-Type: application/json');
                    echo json_encode(['success' => false, 'error' => 'Failed to upload the image.']);
                    exit; // Ensure no further output
                }
            }

            $inserted = Products::addProduct($fieldsToInsert);

            if ($inserted) {
                $newProduct = Products::getProductById((int)$inserted);
                error_log('Product added successfully: ' . print_r($newProduct, true));
                header('Content-Type: application/json');
                echo json_encode(['success' => true, 'message' => 'Product added successfully!', 'product' => $newProduct]);
                exit; // Ensure no further output
            }

            error_log('Failed to add the product.');
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'error' => 'Failed to add the product.']);
            exit; // Ensure no further output
        }

        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'error' => 'Invalid request method']);
        exit; // Ensure no further output
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

//    public function actionUpdateField()
//    {
//        $id = $_POST['id'] ?? null;
//        $field = $_POST['field'] ?? null;
//        $value = $_POST['value'] ?? null;
//
//        header('Content-Type: application/json');
//
//        if ($id && $field && $value) {
//            $product = Products::getProductById((int)$id);
//            if ($product) {
//                $product[$field] = $value;
//                $updated = Products::updateProduct($id, [$field => $value]);
//
//                if ($updated) {
//                    echo json_encode(['success' => true]);
//                } else {
//                    echo json_encode(['success' => false, 'error' => 'Failed to update the product in the database.']);
//                }
//            } else {
//                echo json_encode(['success' => false, 'error' => 'Product not found.']);
//            }
//        } else {
//            echo json_encode(['success' => false, 'error' => 'Invalid input parameters.']);
//        }
//    }

    public function actionUpdateProduct()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;

            if (!$id) {
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'error' => 'Product ID is required.']);
                exit; // Ensure no further output
            }

            $product = Products::getProductById((int)$id);
            if (!$product) {
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'error' => 'Product not found.']);
                exit; // Ensure no further output
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

                // Check if the directory exists, if not, create it
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0775, true);
                }

                $fileName = uniqid() . '_' . $image['name'];
                $filePath = $uploadDir . $fileName;

                if (move_uploaded_file($image['tmp_name'], $filePath)) {
                    $fieldsToUpdate['image'] = file_get_contents($filePath); // Store the raw image data
                } else {
                    header('Content-Type: application/json');
                    echo json_encode(['success' => false, 'error' => 'Failed to upload the image.']);
                    exit; // Ensure no further output
                }
            }

            $updated = Products::updateProduct((int)$id, $fieldsToUpdate);

            if ($updated) {
                $updatedProduct = Products::getProductById((int)$id);
                header('Content-Type: application/json');
                echo json_encode(['success' => true, 'message' => 'Product updated successfully!', 'product' => $updatedProduct]);
                exit; // Ensure no further output
            }

            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'error' => 'Failed to update the product.']);
            exit; // Ensure no further output
        }

        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'error' => 'Invalid request method']);
        exit; // Ensure no further output
    }




}

<?php

namespace controllers;

use core\Controller;
use models\Products;
use models\Categories;

class ProductsController extends Controller
{
    public function actionProduct($id)
    {
        if (is_array($id)) {
            $id = array_shift($id);
        }
        $id = (int)$id;
        //echo "Product ID: " . $id; // Debug statement to check the received ID

        $product = Products::getProductById($id);

        if (!$product) {
            $this->addErrorMessage('Product not found');
            $this->render([]);
            return;
        }

        //var_dump($product); // Debug statement to check fetched product data
        $this->render(['product' => $product]);
    }
}


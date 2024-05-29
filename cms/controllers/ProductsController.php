<?php

namespace controllers;

use core\Controller;
use models\Products;
use models\Categories;

class ProductsController extends Controller
{
    public function actionIndex()
    {
        $products = Products::getAllProducts();
        $this->render(['products' => $products]);
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

        $this->render(['product' => $product]);
    }
}


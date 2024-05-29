<?php

namespace controllers;

use core\Controller;
use models\Categories;
use models\Products;

class CategoriesController extends Controller
{
    public function actionIndex()
    {
        $categories = Categories::getAllCategories();
        if (!$categories) {
            $this->addErrorMessage('No categories found');
        }
        $this->render(['categories' => $categories]);
    }

    public function actionCategory($categoryId = null)
    {
        if (is_array($categoryId)) {
            $categoryId = array_shift($categoryId);
        }
        $categoryId = (int)$categoryId;

        $category = Categories::getCategoryById($categoryId);
        $products = Products::getProductsByCategory($categoryId);

        $data = [
            'category' => $category,
            'products' => $products,
        ];

        $this->render($data);
    }
}

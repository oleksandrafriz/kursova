<?php

namespace models;

use core\Core;
use core\Model;

/**
 * @property int $id Id
 * @property string $color Колір
 * @property string $material Матеріал
 * @property int $size Розмір
 * @property int $code Артикул
 * @property string $metal Метал
 * @property int $category_id Id категорії
 * @property string $name Назва
 * @property float $stone_size Розмір камню
 * @property int $price Ціна
 * @property string $image Зображення
 */

class Products extends Model
{
    public static function getAllProducts()
    {
        return Core::get()->db->select(self::$tableName);
    }

    public static $tableName = 'jewelry';

    public static function getProductById(int $id)
    {
        $product = Core::get()->db->select(self::$tableName, '*', ['id' => $id]);
        if ($product) {
            $product = $product[0];
            $product['image'] = base64_encode($product['image']); // Закодувати зображення в Base64
        }
        return $product;
    }

    public static function getProductsByCategory(int $categoryId)
    {
        $products = Core::get()->db->select(self::$tableName, '*', ['category_id' => $categoryId]);
        foreach ($products as &$product) {
            if (!empty($product['image'])) {
                $product['image'] = 'data:image/jpeg;base64,' . base64_encode($product['image']);
            }
        }
        return $products;
    }
}
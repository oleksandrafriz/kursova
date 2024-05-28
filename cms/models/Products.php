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
 */

class Products extends Model
{
    public static $tableName = 'jewelry';

    public static function getProductById(int $id)
    {
        $product = Core::get()->db->select(self::$tableName, '*', ['id' => $id]);
        //var_dump($product); // Debug statement to check database retrieval
        return $product ? $product[0] : null;
    }

    public static function getProductsByCategory(int $categoryId)
    {
        $products = Core::get()->db->select(self::$tableName, '*', ['category_id' => $categoryId]);
        return $products;
    }
}
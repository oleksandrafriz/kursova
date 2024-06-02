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
    public static $tableName = 'jewelry';
    protected $fieldsArray = [];

    public static function getAllProducts($orderBy = 'price', $orderDirection = 'ASC', $minPrice = null, $maxPrice = null)
    {
        $where = [];
        if (isset($minPrice) && isset($maxPrice)) {
            $where = ['price BETWEEN ? AND ?' => [$minPrice, $maxPrice]];
        }

        $order = "{$orderBy} {$orderDirection}";

        $products = Core::get()->db->select(self::$tableName, '*', $where, $order);
        foreach ($products as &$product) {
            if (!empty($product['image'])) {
                $product['image'] = 'data:image/jpeg;base64,' . base64_encode($product['image']);
            }
        }
        return $products;
    }



    public static function getProductById(int $id)
    {
        $product = Core::get()->db->select(self::$tableName, '*', ['id' => $id]);
        if ($product) {
            $product = $product[0];
            if (!empty($product['image'])) {
                $product['image'] = base64_encode($product['image']);
            }
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

    public function __set($name, $value)
    {
        $this->fieldsArray[$name] = $value;
    }

    public static function updateProduct(int $id, array $fields)
    {
        return Core::get()->db->update(self::$tableName, $fields, ['id' => $id]);
    }


    public static function deleteProduct(int $id)
    {
        return Core::get()->db->delete(self::$tableName, ['id' => $id]);
    }


    public function save()
    {
        $isInsert = false;
        if (!isset($this->id)) {
            $isInsert = true;
        } else {
            $value = $this->id;
            if (empty($value)) {
                $isInsert = true;
            }
        }

        if ($isInsert) {
            $result = Core::get()->db->insert(static::$tableName, $this->fieldsArray);
            if (!$result) {
                throw new \Exception('Failed to insert the record into the database.');
            }
        } else {
            $result = Core::get()->db->update(static::$tableName, $this->fieldsArray, ['id' => $this->id]);
            if (!$result) {
                // Додати повідомлення про помилку
                throw new \Exception('Failed to update the record in the database.');
            }
        }
    }


}
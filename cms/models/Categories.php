<?php

namespace models;

use core\Core;
use core\Model;

/**
 * @property int $id Id
 * @property string $name Назва
 * @property string $image Зображення
 */
class Categories extends Model
{
    public static $tableName = 'categories';

    public static function getAllCategories()
    {
        $categories = Core::get()->db->select(self::$tableName);
        foreach ($categories as &$category) {
            if (!empty($category['image'])) {
                $category['image'] = 'data:image/jpeg;base64,' . base64_encode($category['image']);
            }
        }
        return $categories;
    }

    public static function getCategoryById(int $id)
    {
        return Core::get()->db->select(self::$tableName, ['id' => $id]);
    }


}

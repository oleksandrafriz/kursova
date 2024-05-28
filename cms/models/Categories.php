<?php

namespace models;

use core\Core;
use core\Model;

/**
 * @property int $id Id
 * @property string $name Назва
 */
class Categories extends Model
{
    public static $tableName = 'categories';

    public static function getAllCategories()
    {
        return Core::get()->db->select(self::$tableName);
    }

    public static function getCategoryById(int $id)
    {
        return Core::get()->db->select(self::$tableName, ['id' => $id]);
    }


}

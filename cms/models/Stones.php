<?php

namespace models;

use core\Core;
use core\Model;

/**
 * @property int $id Id
 * @property int $size Розмір
 * @property string $name Назва
 * @property string $image Зображення
 */

class Stones extends Model
{
    public static $tableName = 'stones';
    protected $fieldsArray = [];

    public static function getAllStones()
    {
        $stones = Core::get()->db->select(self::$tableName);
        foreach ($stones as &$stone) {
            if (!empty($stone['image'])) {
                $stone['image'] = base64_encode($stone['image']);
            }
        }
        return $stones;
    }

    public static function getStoneById(int $id)
    {
        $stone = Core::get()->db->select(self::$tableName, '*', ['id' => $id]);
        if ($stone) {
            $stone = $stone[0];
            if (!empty($stone['image'])) {
                $stone['image'] = base64_encode($stone['image']);
            }
        }
        return $stone;
    }


    public static function addStone(array $fields)
    {
        return Core::get()->db->insert(self::$tableName, $fields);
    }

    public static function updateStone(int $id, array $fields)
    {
        return Core::get()->db->update(self::$tableName, $fields, ['id' => $id]);
    }

    public static function deleteStone($id)
    {
        return Core::get()->db->delete(self::$tableName, ['id' => $id]);
    }
}
<?php

namespace models;

use core\Core;
use core\Model;

/**
 * @property string $title заголовок новини
 * @property string $text текст новини
 * @property string $short_text короткий текст новини
 * @property string $date дата новини
 * @property string $id ID новини
 */
class News extends Model
{
    public static $tableName = 'news';
}

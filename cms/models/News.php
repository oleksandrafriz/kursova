<?php

namespace models;

class News
{
    public $id;
    public $title;
    public $text;
    public $short_text;
    public $date;

    public function __construct()
    {

    }

}

$news = new News::findById(10);
$news->text = 'text';
//$news->title = 'title';
//$news->date = '2024-04-30 17:10';
$news->save();
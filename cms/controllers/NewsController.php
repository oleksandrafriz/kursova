<?php

namespace controllers;

use core\Controller;
use core\Core;
use core\Template;
use models\News;

class NewsController extends Controller
{
    // news/add
    public function actionAdd(){
        return $this->render();
    }

    // news/index
    public function actionIndex(){
        $db = Core::get()->db;

        $news = new News();
        $news->id = 1;
        $news->title = '!!!! text !!!!!';
        $news->text = '!!!! text !!!!!';
        $news->short_text = '!!!! text !!!!!';
        $news->date = '0204-05-01 21:21:00';
        $news->save(); //update, insert

        /*$rows = $db->select("news", ["title"], [
            'id' => 1
        ]);*/

        /*$db->insert('news', [
            'title' => 'Zagolovok',
            'text' => 'text',
            'short_text' => 'short text',
            'date' => '2024-06-12 19:00:00'
        ]);*/

        /*$db->delete('news', [
            'id' => 4
        ]);
        return $this->render();*/

        /*$db->update('news', [
            'title' => '!!!!!!!!'
        ],
        [
            'id' => 1
        ]
        );*/

        return $this->render();
    }

    // news/view
    public function actionView($params){
        return $this->render();
    }
}
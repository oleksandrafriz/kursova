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

//      News::deleteById(6); // видалення за id
//      News::deleteByCondition(['title' => '!!!! text !!!!!']); // видалення за умовою
        /*$res = News::findById(2); // знаходження за id
        var_dump($res);
        die;*/

        /*$res = News::findByCondition(['id' => 2]); // знаходження за умовою
        var_dump($res);
        die;*/

//        $news = new News();
//        $news->id = 1;
//        $news->title = '!!!! text !!!!!';
//        $news->text = '!!!! text !!!!!';
//        $news->short_text = '!!!! text !!!!!';
//        $news->date = '0204-05-01 21:21:00';
//        $news->save(); //update, insert

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

        //Core::get()->session->set('user_id', 1); //записати в сесію
        //Core::get()->session->setValues(['user_id' => 1, 'user_login' => 'Sasha']); //записати декілька в сесію
        //$id = Core::get()->session->get('user_id'); //зчитування з сесії

        return $this->render('views/news/view.php');
    }

    // news/view
    public function actionView($params){
        return $this->render();
    }
}
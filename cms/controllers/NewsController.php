<?php

namespace controllers;

class NewsController
{
    // news/add
    public function actionAdd(){
        echo 'NewsController -> actionAdd';
    }

    // news/index
    public function actionIndex(){
        echo 'NewsController -> actionIndex';
    }

    public function actionView($params){
        var_dump($params);
    }
}
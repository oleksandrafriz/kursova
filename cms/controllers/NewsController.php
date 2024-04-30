<?php

namespace controllers;

use core\Controller;
use core\Template;

class NewsController extends Controller
{
    // news/add
    public function actionAdd(){
        return $this->render();
    }

    // news/index
    public function actionIndex(){
        return $this->render();
    }

    // news/view
    public function actionView($params){
        return $this->render();
    }
}
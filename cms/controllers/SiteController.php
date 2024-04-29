<?php

namespace controllers;

class SiteController
{
    public function actionIndex(){
    echo 'main page';
    }
    public function actionError($code){
        echo $code;
    }
}
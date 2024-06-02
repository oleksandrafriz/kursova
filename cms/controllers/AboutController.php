<?php

namespace controllers;

use core\Controller;

class AboutController extends Controller
{
    public function actionIndex()
    {
        $contentArray = $this->render();
        $content = $contentArray['Content'];
        $this->template->setParam('Content', $content);
        echo $this->template->getHTML();
    }

    public function actionError($code)
    {
        echo $code;
    }
}
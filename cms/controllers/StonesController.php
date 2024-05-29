<?php

namespace controllers;

use core\Controller;
use models\Stones;

class StonesController extends Controller
{
    public function actionIndex()
    {
        $stones = Stones::getAllStones();
        if (!$stones) {
            $this->addErrorMessage('No stones found');
        }
        $this->render(['stones' => $stones]);
    }
}
<?php

namespace controllers;

use core\Controller;
use core\Core;
use models\Users;

class UsersController extends Controller
{
    public function actionLogin()
    {
        if ($this->isPost){
            //echo $this->post->password; // or all instead of login
            $user = Users::FindByLoginAndPassword($this->post->login, $this->post->password);
            if(!empty($user)){
                Users::LoginUser($user);
                return $this->redirect('/');
//                header('Location: /');
//                die;
            }else
                $this->template->setParam('error_message', 'Неправильний логін та/або пароль');
        }
            return $this->render();
    }

    public function actionLogout(){
        Users::LogoutUser();
        return $this->redirect('/users/login');
    }
}
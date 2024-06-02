<?php

namespace controllers;

use core\Controller;
use core\Core;
use models\Users;

class UsersController extends Controller
{
    public function actionLogin()
    {
        if (Users::IsUserLogged()) {
            return $this->redirect('/');
        }

        if ($this->isPost) {
            $user = Users::FindByLoginAndPassword($this->post->login, $this->post->password);
            if (!empty($user)) {
                Users::LoginUser($user);
                Core::get()->session->set('isAdmin', Users::isAdmin($user['login'], $user['password']));
                return $this->redirect('/');
            } else {
                $this->addErrorMessage('Неправильний логін та/або пароль');
            }
        }

        return $this->render();
    }


    public function actionLogout()
    {
        Users::LogoutUser();
        Core::get()->session->remove('isAdmin');
        return $this->redirect('/users/login');
    }

}
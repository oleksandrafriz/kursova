<?php

namespace models;

use core\Core;
use core\Model;

/**
 * @property int $id Id
 * @property string $login Логін
 * @property string $password Пароль
 */
class Users extends Model
{
    public static $tableName = 'users';

    public static function FindByLoginAndPassword($login, $password)
    {
        $rows = self::findByCondition(['login' => $login, 'password' => $password]);

        if (!empty($rows))
            return $rows[0];
        else
            return null;
    }

    public static function FindByLogin($login)
    {
        $rows = self::findByCondition(['login' => $login]);

        if (!empty($rows))
            return $rows[0];
        else
            return null;
    }

    public static function IsUserLogged()
    {
        return !empty(Core::get()->session->get('user'));
    }

    public static function LoginUser($user)
    {
        Core::get()->session->set('user', $user);
    }

    public static function LogoutUser(){
        Core::get()->session->remove('user');
    }

    public static function isAdmin($login, $password)
    {
        return $login === 'admin@ztu.edu.ua' && $password === 'admin';
    }
}
<?php

namespace core;

use PDO;

class DB
{
    public $pdo;
    public function __construct()
    {
        $host = Config::get()->dbHost;
        $name = Config::get()->dbName;
        $login = Config::get()->dbLodin;
        $password = Config::get()->dbPassword;

        $this->pdo = new \PDO('mysql:host=localhost;dbname=cms', 'root', '');
    }
}
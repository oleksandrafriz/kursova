<?php

namespace core;

class Router
{
    protected $route;
    protected $indexTemplate;
    public function __construct($route)
    {
        $this->route = $route;
        $this->indexTemplate = new \core\Template('views/layouts/index.php');

    }
    public function run()
    {
        $parts = explode('/', $this->route);
        if(strlen($parts[0]) == 0){
            $parts[0] = 'site';
            $parts[1] = 'index';
        }

        if(count($parts) == 1){
            $parts[1] = 'index';
        }
        $controller = 'controllers\\'.ucfirst($parts[0]).'Controller'; // news -> (News) NewsController
        $method = 'action'.ucfirst($parts[1]); // add -> actionAdd

        if(class_exists($controller)){
            $controllerObject = new $controller();
            if(method_exists($controller, $method)){
                array_splice($parts, 0, 2);
               $params = $controllerObject -> $method($parts);
               $this->indexTemplate->setParams($params);
            }else
                $this->error(404);
        }else
            $this->error(404);


    }

    public function done()
    {
        $this->indexTemplate->display();
    }

    public function error($code)
    {
        http_response_code($code);
        switch($code){
            case 404:
                echo '<h1>404 Not Found</h1>';
                break;
        }
    }
}
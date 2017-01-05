<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 04.01.17
 * Time: 17:12
 */

namespace fw;

use controllers\AppController;

class ActionLoader
{
    private $controller;
    private $action;

    /**
     * Load controller and action to class from address row
     */
    private function loadClassNames()
    {
        if (isset($_GET['p'])) {
            $p = $_GET['p'];
            $p = explode('/', $p);
            if (isset($p[0]) && isset($p[1])) {
                $this->controller = $p[0];
                $this->action = $p[1];
            }
            if (isset($p[0])) {
                $this->controller = $p[0];
            }
            return true;
        }
        return false;
    }

    /**
     * Load classes for route
     * If class not found then load app/start route
     */
    public function load()
    {
        if ($this->loadClassNames()) {
            if ($this->controller) {
                $controller = $this->loadController();
                if(!$controller){
                    return (new AppController())->error();
                }
                $this->loadAction($controller);
            }
        } else {
            $controller = new AppController();
            $controller->start();
        }

    }

    /**
     * Load controller
     */
    private function loadController()
    {
        $name = 'controllers\\' . (ucfirst($this->controller) . 'Controller');

        if ($this->exist($name)) {
            $controller = new $name;
            return $controller;
        }
        return false;
    }

    /**
     * Load action
     */
    private function loadAction($controller)
    {
        if ($this->action) {
            $action = $this->action;
            if (method_exists($controller, $action)) {
                $controller->{$action}();
            } else {
                (new AppController())->error();
            }

        } else {
            $controller->start();
        }
    }

    /**
     * Check if class exist
     * @param $className
     * @return bool
     */
    private function exist($className)
    {
        $filename = '../' . str_replace('\\', '/', $className) . ".php";
        if (file_exists($filename)) {
            if (class_exists($className)) {
                return true;
            }
        }
        return false;
    }


}
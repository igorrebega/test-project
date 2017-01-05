<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 04.01.17
 * Time: 18:08
 */

namespace controllers;


use fw\BaseController;
use models\LoginForm;

class UserController extends BaseController
{
    /**
     * Render login form
     */
    public function start(){
        $login = new LoginForm();
        if(isset($_POST['login']) or isset($_POST['password'])){
            $login->login();
        }

        return $this->render('user/login',['model'=>$login]);
    }

    /**
     * Logout oser
     */
    public function logout(){
        $this->checkAuth();

        $login = new LoginForm();
        $login->logout();

    }
}
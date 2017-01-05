<?php

namespace controllers;
use fw\BaseController;

class AppController extends BaseController
{
    /**
     * Start app controller
     * @return mixed
     */
    public function start(){
        return $this->render('start');
    }

    /**
     * Render error page
     * @return mixed
     */
    public function error(){
        return $this->render('error');
    }


}
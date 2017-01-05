<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 04.01.17
 * Time: 16:31
 */

namespace fw;

class BaseController
{

    /**
     * Render view with layout
     *
     * @param $name
     * @param array $params
     * @return mixed
     * @throws \ErrorException
     */
    protected function render($name, $params = []){
        $url = '../views/'.$name.'.php';
        if(file_exists($url)){
            $content =  $this->renderPhpFile($url,$params);
            return require ('../views/layout/main.php');
        }
        else{
            throw new \ErrorException("Not fount render file");
        }
    }

    /**
     * Render view without layout
     * @param $name
     * @param array $params
     * @throws \ErrorException
     */
    public static function renderPartial($name, $params = []){
        $url = '../views/'.$name.'.php';
        if(file_exists($url)){
            extract($params, EXTR_OVERWRITE);
            require ($url);
        }
        else{
            throw new \ErrorException("Not fount render file");
        }
    }

    /**
     * Render one php file
     * @param $_file_
     * @param array $_params_
     * @return string
     */
    protected function renderPhpFile($_file_, $_params_ = [])
    {
        ob_start();
        ob_implicit_flush(false);
        extract($_params_, EXTR_OVERWRITE);
        require($_file_);

        return ob_get_clean();
    }

    /**
     * Check if user is auth
     */
    protected function checkAuth(){
        if (!isset($_SESSION['login_user'])){
            header("Location: /");
        }
    }
}
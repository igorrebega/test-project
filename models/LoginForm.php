<?php

namespace models;


use fw\Db;

class LoginForm extends Db
{
    public $login = '';
    public $password = '';

    /**
     * Login user
     */
    public function login()
    {
        if(isset($_SESSION['login_user']['id'])){
            header("location: index.php?app");
        }

        $this->loadParams();

        if ($this->login and $this->password) {
            $query = "SELECT id,login,password from user where login = ?";
            $db = $this->db;
            if ($stmt = $db->prepare($query)) {
                $stmt->bind_param("s", $this->login);

                $stmt->execute();
                $stmt->bind_result($id,$login,$password);
                $stmt->fetch();
                if($id && $login && password_verify($this->password,$password)){
                    $_SESSION['login_user']['id'] = $id;
                    $_SESSION['login_user']['login'] = $login;

                    header("location: index.php?app");
                }

                $stmt->close();
            }
        }
        echo "No valid data";
    }

    /**
     * Logout user
     */
    public function logout(){
        if(isset($_SESSION['login_user'])){
            unset($_SESSION['login_user']);
            header("location: index.php?app");
        }else{
            header("location: index.php?app\error");
        }
    }

    /**
     * Load params to class
     */
    private function loadParams(){
        if (isset($_POST['login'])) {
            $this->login = $_POST['login'];
        }
        if (isset($_POST['password'])) {
            $this->password = $_POST['password'];
        }

    }
}
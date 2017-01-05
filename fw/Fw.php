<?php

namespace fw;

class Fw
{
    /**
     * Main start function
     */
    static function start()
    {
        session_start();
        require_once("Autoloader.php");
        require_once("../configs/config.php");

        $loader = new ActionLoader();
        $loader->load();

    }

}

Fw::start();
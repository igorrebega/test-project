<?php
namespace fw;

class Db
{
    public  $db;
    function __construct()
    {
        $this->db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
    }
}
<?php

namespace App\Infrastructure\Handler;

class DatabaseHandler
{
    public function getConnection()
    {
        $host = "localhost";
        $username = "username";
        $pass = "password";

        try {
            $conn = new \PDO("mysql:host=$host;dbname=myDB", $username, $pass);
            // set the PDO error mode to exception
            $conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            echo "Connected successfully";
        }
        catch(\PDOException $e)
        {
             var_dump("Connection failed: " . $e->getMessage());die();
        }

//        var_dump("Connected successfully");die();
    }
}
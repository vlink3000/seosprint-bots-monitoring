<?php

namespace App\Infrastructure\Connector;

use Illuminate\Database\Capsule\Manager as Capsule;

class DatabaseConnector
{
    public function getConnection(): Capsule
    {
        $capsule = new Capsule;

        $capsule->addConnection([
            "driver" => "mysql",
            "host" =>"localhost",
            "port" => "8889",
            "database" => "seosprint_bots_monitoring",
            "username" => "root",
            "password" => "root"
        ]);

        $capsule->setAsGlobal();
        $capsule->bootEloquent();
        $capsule->bootEloquent();

        return $capsule;
    }
}
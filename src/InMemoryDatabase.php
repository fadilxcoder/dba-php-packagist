<?php

namespace InMemory\Dba;

use InMemory\Dba\Core\Cache;
use InMemory\Dba\Core\Sweep;

class InMemoryDatabase
{
    public static $connection;

    private const DB_NAME = "app.db4";

    public function initialize(): Cache
    {
        if (!is_dir($this->path())) {
            mkdir($this->path(), 0777, true);
        }

        if (!isset(self::$connection)) {
            self::$connection = new Cache($this->path() . "/" . self::DB_NAME , 'db4');
        }

        return self::$connection;
    }

    public function truncate(): void
    {
        $sweep = new Sweep($this->initialize());
        $sweep->flush();
        self::$connection = null;
    }

    private function path(): string
    {
        if (in_array(PHP_SAPI, ['cli'], true)) {
            return realpath("") . "/var/storage";
        }
        
        return realpath("") . "/../var/storage";
    }
}
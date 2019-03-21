<?php

namespace App;
use App\TSingletone;

/**
 * Class Config
 * @package App
 */
class Config
{
    use TSingletone;

    protected static $data = [];

    protected function __construct()
    {
        self::$data = include __DIR__ . '/../config/config_data.php';
    }

    public function getData()
    {
        return self::$data;
    }
}

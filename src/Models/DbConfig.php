<?php

namespace App\Models;

class DbConfig
{
    public $dsn;

    public function __construct($dsn)
    {
        $this->dsn = $dsn;
    }
}

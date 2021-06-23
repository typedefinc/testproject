<?php

require_once "vendor/autoload.php";
\App\Base\BasicAuth::auth();
\App\Base\Route::run();

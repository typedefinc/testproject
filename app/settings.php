<?php

use DI\Container;

return function (Container $container) {
    $container->set('settings', [
            'displayErrorDetails' => true,
            'logErrors'            => false,
            'logErrorDetails'     => false,
            'dsn' => 'sqlite:../db/database.db',
        ]);
};

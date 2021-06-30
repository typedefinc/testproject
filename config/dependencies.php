<?php

use Laminas\ConfigAggregator\ConfigAggregator;
use Laminas\ConfigAggregator\PhpFileProvider;

$environment = APP_ENV;

$aggregator = new ConfigAggregator([
    new PhpFileProvider('../config/common/*.php'),
    new PhpFileProvider("../config/{$environment}/*.php"),
]);
return $aggregator->getMergedConfig();

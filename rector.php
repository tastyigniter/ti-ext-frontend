<?php

declare(strict_types=1);

use SamPoyigi\Testbench\RectorConfig;

return RectorConfig::configure()
    ->withPhpSets(php83: true)
    ->withPaths([
        __DIR__.'/database',
        __DIR__.'/src',
        __DIR__.'/tests',
    ]);

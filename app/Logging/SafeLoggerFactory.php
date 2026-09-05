<?php

namespace App\Logging;

class SafeLoggerFactory
{
    public function __invoke(array $config): SafeLogger
    {
        return new SafeLogger;
    }
}

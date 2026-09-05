<?php

namespace App\Logging;

use Psr\Log\LoggerInterface;

class SafeLogger implements LoggerInterface
{
    public function emergency($message, array $context = [])
    {
        $this->log('emergency', $message, $context);
    }

    public function alert($message, array $context = [])
    {
        $this->log('alert', $message, $context);
    }

    public function critical($message, array $context = [])
    {
        $this->log('critical', $message, $context);
    }

    public function error($message, array $context = [])
    {
        $this->log('error', $message, $context);
    }

    public function warning($message, array $context = [])
    {
        $this->log('warning', $message, $context);
    }

    public function notice($message, array $context = [])
    {
        $this->log('notice', $message, $context);
    }

    public function info($message, array $context = [])
    {
        $this->log('info', $message, $context);
    }

    public function debug($message, array $context = [])
    {
        $this->log('debug', $message, $context);
    }

    public function log($level, $message, array $context = [])
    {
        $line = sprintf('[%s] local.%s: %s', date('Y-m-d H:i:s'), strtoupper((string) $level), (string) $message);

        if ($context) {
            $line .= ' '.json_encode($context, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        }

        file_put_contents(storage_path('logs/laravel.log'), $line.PHP_EOL, FILE_APPEND | LOCK_EX);
    }
}

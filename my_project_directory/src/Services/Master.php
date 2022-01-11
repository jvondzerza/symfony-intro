<?php

namespace App\Services;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
class Master
{

    private TransformInterface $transformObj;
    private Logger $logger;

    /**
     * @param TransformInterface $transformObj
     * @param Logger $logger
     */
    public function __construct(TransformInterface $transformObj, Logger $logger)
    {
        $this->transformObj = $transformObj;
        $this->logger = $logger;
    }

    public function log(string $string): void
    {
        $this->logger->pushHandler(new StreamHandler(__DIR__ . '/logs/log.info', Logger::DEBUG));
        $this->logger->info($string);
    }

    public function edit(string $string): string
    {
        return $this->transformObj->transform($string);
    }

}
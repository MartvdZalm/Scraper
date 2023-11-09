<?php

namespace KnightScraper\Logger;

class Logger
{
    public function __construct()
    {

    }

    private function getDate(): string
    {
        return '['.date('H:i:s').']';
    }

    public function error(string $message): void
    {
        echo($this->getDate()." Error: " . $message . "\n");
    }

    public function warning(string $message): void
    {
        echo($this->getDate()." Warning: " . $message . "\n");
    }

    public function info(string $message): void
    {
        echo($this->getDate()." Info: " . $message . "\n");
    }
}

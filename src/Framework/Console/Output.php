<?php

namespace Framework\Console;

class Output
{
    public function write(string $message)
    {
        echo $message;
    }

    public function writeln(string $message)
    {
        echo $message . PHP_EOL;
    }

    public function comment(string $message)
    {
        $this->writeln("\33[33m" . $message . "\33[0m");
    }

    public function info(string $message)
    {
        $this->writeln("\33[32m" . $message . "\33[0m");
    }
}
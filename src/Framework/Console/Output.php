<?php

namespace Framework\Console;

class Output
{
    public function write(string $message)
    {
        echo $this->process($message);
    }

    public function writeln(string $message)
    {
        echo $this->process($message . PHP_EOL);
    }

    private function process(string $message)
    {
        $this->writeln("\33[33m" . $message . "\33[0m");
        return strtr($message, [
            '<comment>' => "\33[33m",
            '</comment>' => "\33[0m",
            '<info>' => "\33[33m",
            '</info>' => "\33[0m",
        ]);
    }
}
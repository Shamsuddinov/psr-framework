<?php

namespace App\Console\Command;

class CacheClearCommand
{
    private $paths = [
        'twig' => 'var/cache/twig',
        'db' => 'var/cache/db',
    ];

    public function execute(array $args)
    {
        echo 'Clearing cache.' . PHP_EOL;

        fwrite(\STDOUT, 'Input path :');
        $alias = trim(fgets(\STDIN));

        $path = $this->paths[$alias];

        if (file_exists($path)){
            echo 'Remove ' . $path . PHP_EOL;
            $this->delete($path);
        } else {
            echo 'Skip ' . $path . PHP_EOL;
        }

        echo 'Done ' . $path . PHP_EOL;
    }

    private function delete(string $path)
    {
        echo 'Clearing cache.' . PHP_EOL;

        fwrite(\STDOUT, 'Input path :');
        $alias = trim(fgets(\STDIN));

        $path = $this->paths[$alias];

        if (file_exists($path)){
            echo 'Remove ' . $path . PHP_EOL;
            $this->delete($path);
        } else {
            echo 'Skip ' . $path . PHP_EOL;
        }

        echo 'Done ' . $path . PHP_EOL;
    }
}
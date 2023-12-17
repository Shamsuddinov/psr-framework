<?php

declare(strict_types=1);

namespace Framework\Console;

abstract class Command
{
    private $name;
    private $description;

    public function __construct(string $name = null)
    {
        if ($name != null){
            $this->setName($name);
        } else {
            $this->setName(static::class);
        }

        $this->configure();
    }

    protected function configure()
    {

    }

    abstract public function execute(Input $input, Output $output);

    public function getName()
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription(string $description)
    {
        $this->description = $description;
        return $this;
    }
}
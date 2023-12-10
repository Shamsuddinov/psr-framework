<?php

namespace Framework\Container;

use Psr\Container\ContainerInterface;

class Container implements ContainerInterface
{
    private $defenitions = [];
    private $results = [];

    /**
     * @throws \ReflectionException
     */
    public function get($id)
    {
        if (array_key_exists($id, $this->results)) {
            return $this->results[$id];
        }

        if (!array_key_exists($id, $this->defenitions)) {
            if (class_exists($id)) {
                $reflection = new \ReflectionClass($id);
                $arguments = [];

                if (($constructor = $reflection->getConstructor()) != null) {
                    foreach ($constructor->getParameters() as $parameter) {
                        $paramClass = $parameter->getClass();
                        $arguments[] = $this->get($paramClass->getName());
                    }
                }
                $result = $reflection->newInstanceArgs($arguments);
                return $this->results[$id] = $result;
            }

            throw new ServiceNotFoundException('Undefined argument '. $id);
        }

        $defenition = $this->defenitions[$id];

        if ($defenition instanceof \Closure) {
            $this->results[$id] = $defenition($this);
        } else {
            $this->results[$id] = $defenition;
        }

        return $this->results[$id];
    }

    public function has($id): bool
    {
        return array_key_exists($id, $this->defenitions) || class_exists($id);
    }

    public function set($id, $value)
    {
        if (array_key_exists($id, $this->results)) {
            unset($this->results[$id]);
        }

        $this->defenitions[$id] = $value;
    }
}

<?php

namespace Framework\Template\Php;

abstract class Extension
{
    /**
     * @return SimpleFunction[]
     */
    public function getFunctions(): array
    {
        return [
            new SimpleFunction('path', [$this, 'generatePath']),
        ];
    }
}
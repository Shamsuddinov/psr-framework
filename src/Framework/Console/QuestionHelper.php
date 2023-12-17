<?php

namespace Framework\Console;

class QuestionHelper
{
    public static function choose(Input $input,Output $output, string $prompt, array $options)
    {
        do{
            $output->writeln($prompt . ' [' . implode(',', $options) . ']:');
            $choose = trim($input->read());
        } while(!in_array($choose, $options, true));

        return $choose;
    }
}
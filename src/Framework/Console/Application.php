<?php

namespace Framework\Console;

class Application
{
    private $commands;

    public function add(Command $command)
    {
        $this->commands[] = $command;
    }

    public function run(Input $input, Output $output)
    {
        if ($name = $input->getArgument(0)){
            $command = $this->resolveCommand($name);
            $command->execute($input, $output);
        } else {
            $this->renderHelp($output);
        }
    }

    private function resolveCommand($name)
    {
        foreach ($this->commands as $command){
            if ($command->getName() == $name){
                return $command;
            }
        }

        throw new \InvalidArgumentException('Undefined command' . $name);
    }

    private function renderHelp(Output $output)
    {
        $output->writeln('<comment>Available command:</comment>');
        $output->writeln('');

        foreach ($this->commands as $command){
            $output->writeln('<info>' . $command->getName() .'</info>' . '\t' . $command->getDescription());
        }
        $output->writeln('');
    }
}
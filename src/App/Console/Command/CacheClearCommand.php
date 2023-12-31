<?php

namespace App\Console\Command;

use App\Service\FileManager;
use Framework\Console\Input;
use Framework\Console\Output;
use Framework\Console\Question;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;

class CacheClearCommand extends Command
{
    private $paths;
    private $files;

    public function  __construct(array $paths, FileManager $files)
    {
        $this->paths = $paths;
        $this->files = $files;
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName('cache:clear')
            ->setDescription('Clear cache')
            ->addArgument('alias', InputArgument::OPTIONAL, 'The alias of available paths.')
        ;
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('<comment>Clearing cache</comment>.');

        $alias = $input->getArgument('alias');

        if (empty($alias)){
            $options = array_merge(['all'], array_keys($this->paths));
            $alias = QuestionHelper::choose($input, $output, 'Choose path', $options);
        }

        if ($alias === 'all'){
            $paths = $this->paths;
        } else {
            if (!array_key_exists($alias, $this->paths)){
                throw new \InvalidArgumentException('Unknown path alias : ' . $alias);
            }
            $paths = [$alias => $this->paths[$alias]];
        }

        foreach ($paths as $path){
            if ($this->files->exists($path)){
                $output->writeln('Remove ' . $path);
                $this->files->delete($path);
            } else {
                $output->writeln('Skip ' . $path);
            }
        }

        $output->writeln('<info>Done</info>');
    }
}
<?php


namespace AppBundle\Command;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class PokedexImportCommand extends Command
{
    protected static $defaultName = 'lbo:pokedex:import';
    protected static $defaultDescription = 'Imports a .csv of file into the database.';
    protected static $defaultHelp = 'Custom Import Command
        This command checks your .csv file and imports its data into the configured database.
        Invalid lines do NOT stop the import.
         
        The command should be run as follows : bin/console lbo:pokedex:import yourfile.csv';

    protected static $defaultFileArgumentName = 'fileName';
    protected static $defaultFileArgumentDescription = 'The user\'s file that is going to be imported to the database';

    protected function configure()
    {
        $this
            ->setName($this::$defaultName)
            ->setDescription($this::$defaultDescription)
            ->setHelp($this::$defaultHelp)
            ->addArgument(
                $this::$defaultFileArgumentName,
                InputArgument::REQUIRED,
                $this::$defaultFileArgumentDescription
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln([
            'Pokedex',
            '============',
            '',
        ]);

        $output->writeln('Pokedex: '.$input->getArgument('fileName'));
    }
}
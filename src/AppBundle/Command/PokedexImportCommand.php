<?php


namespace AppBundle\Command;


use AppBundle\Entity\Pokemon;
use AppBundle\Service\PokemonService;
use Doctrine\ORM\ORMException;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class PokedexImportCommand extends ContainerAwareCommand
{
    //////////////////////
    /// Static strings ///
    //////////////////////

    protected static $defaultName = 'lbo:pokedex:import';
    protected static $defaultDescription = 'Imports a .csv of file into the database.';
    protected static $defaultHelp = 'Custom Import Command
        This command checks your .csv file and imports its data into the configured database.
        Invalid lines do NOT stop the import.
         
        The command should be executed as follows : bin/console lbo:pokedex:import yourfile.csv';

    protected static $defaultFileArgumentName = 'fileName';
    protected static $defaultFileArgumentDescription = 'The user\'s file that is going to be imported to the database';

    protected static $formattedFirstLine = "id,identifier,species_id,height,weight,base_experience,order,is_default\n";
    protected static $errorFileNotFound = 'Error : File not found, aborting import...';
    protected static $errorInvalidFirstLine = 'Error : The first line is invalid, the file might not be formatted properly. Aborting import';

    //////////////////
    /// Parameters ///
    //////////////////

    protected $logger;
    protected $pokemonService;

    /////////////////////////////
    /// Constructor & Methods ///
    /////////////////////////////

    public function __construct(LoggerInterface $logger, PokemonService $pokemonService, $name = null)
    {
        $this->logger = $logger;
        $this->pokemonService = $pokemonService;

        parent::__construct($name);
    }

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
            'Importing Pokedex from .csv file',
            '============',
            '',
        ]);

        $filePath = realpath($this->getContainer()->get('kernel')->getRootDir() . '/../' . $input->getArgument('fileName'));
        if ( ! $filePath) {
            $this->logger->error($this::$errorFileNotFound);
            exit(2);
        }

        $file = fopen($filePath, 'r');
        $firstLine = fgets($file);
        if ( strcmp($firstLine, $this::$formattedFirstLine) != 0 ) {
            $this->logger->error($this::$errorInvalidFirstLine);
            exit(3);
        }

        $lineNumber = 2;
        $imported = 0;
        while ( ! feof($file) ) {
            $line = fgets($file);
            $pokemonAsArray = explode(',', $line);

            if ( count($pokemonAsArray) == 8 ) {
                $pokemon = (new Pokemon())
                    ->setName($pokemonAsArray[1])
                    ->setSpecies($pokemonAsArray[2])
                    ->setHeight($pokemonAsArray[3])
                    ->setWieght($pokemonAsArray[4])
                    ->setBaseExperience($pokemonAsArray[5])
                    ->setOrder($pokemonAsArray[6])
                    ->setDefault(rtrim($pokemonAsArray[7]));

                try {
                    $this->pokemonService->save($pokemon);
                    $imported++;

                    $this->logger->info('Success: the line ' . $lineNumber . ' has been successfully imported into the database');
                } catch (\Exception $e) {
                    $this->logger->error('Error: the line ' . $lineNumber . ' is invalid, continuing import...');
                }
            }

            $lineNumber++;
        }

        $output->writeln([
            '',
            '',
            'Import complete: ' . $imported . ' elements have been imported into the database.'
        ]);
    }
}
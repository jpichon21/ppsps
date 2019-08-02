<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\KernelInterface;
use App\Entity\Person;

class ImportPersonnCommand extends Command
{

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(?string $name = null, EntityManagerInterface $entityManager, KernelInterface $kernel)
    {
        parent::__construct($name);
        $this->entityManager = $entityManager;
        $this->kernel = $kernel;
    }
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'app:import-personn';

    protected function configure()
    {
        $this->setDescription('Import all situation');
        $this->setHelp('This command import all situation');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $finder = new Finder();
        $finder->files()->in($this->kernel->getRootDir().'/ImportFile');
        $serializer = new Serializer([new ArrayDenormalizer(), new GetSetMethodNormalizer()], [new CsvEncoder()]);
        foreach ($finder as $file) {
            if ($file->getFileName() === 'personne.csv') {
                $persons = $serializer->deserialize($file->getContents(),Person::class.'[]','csv');
            }
        }

        foreach ($persons as $person) {
            dump($person);
            $this->entityManager->persist($person);
        }
        $this->entityManager->flush();
    }
}
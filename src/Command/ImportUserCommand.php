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
use App\Entity\User;
use App\Entity\Groupment;

class ImportUserCommand extends Command
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
    protected static $defaultName = 'app:import-user';

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
            if ($file->getFileName() === 'user.csv') {
                $persons = $serializer->deserialize($file->getContents(),Person::class.'[]','csv');
            }
        }
        $groups = [
            "ROUGEOT MEURSAULT",
            "ROUGEOT TERRITOIRE DE SENS",
            "ROUGEOT ILE DE FRANCE",
            "PELICHET",
            "DESERTOT",
            "BONGARZONE",
            "ROUGEOT LYON METROPOLE",
            "GRAGLIA",
            "GANDIN",
            "RUIZ BY ROUGEOT",
        ];

        
        foreach ($groups as $group) {
            $groupment = new Groupment;
            $groupment->setName($group);
            foreach ($persons as $person) {
                if ($person->getCompany() === $group) {
                    $user = new User;
                    $user->setName($person->getName());
                    $user->setEmail($person->getEmail());
                    if ($person->getFunction() === "user") {
                        $user->setRoles(["ROLE_USER"]);
                        $user->setPassword('$2y$10$QcT1FX1OL.NHu3ABDtpSWeofaIsTG6mGl0vlqIF2M.PaDwzfkd4oG');
                    } else {
                        $user->setRoles(["ROLE_ADMIN"]);
                        $user->setPassword('$2y$10$MCq7B/nR/zhg7f0i/mlQkOriE/VqTA4H3A4hShFrhGbDHF7Ixraxm');
                    }
                    $groupment->addUser($user);
                    $this->entityManager->persist($user);
                }
                $this->entityManager->persist($groupment);
            }
        }
        $this->entityManager->flush();
    }
}
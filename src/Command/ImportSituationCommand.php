<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Finder\Finder;
use App\Entity\Situation;
use App\Entity\Tool;
use App\Entity\Risk;
use App\Entity\Measure;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\SituationGroup;
use Symfony\Component\HttpKernel\KernelInterface;

class ImportSituationCommand extends Command
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
    protected static $defaultName = 'app:import-situation';

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
            if ($file->getFileName() === 'activites.csv') {
                $situationGroups = $serializer->deserialize($file->getContents(),SituationGroup::class.'[]','csv');
            }
            if ($file->getFileName() === 'situation.csv') {
                $situations = $serializer->deserialize($file->getContents(),Situation::class.'[]','csv');
            }
            if ($file->getFileName() === 'moyen.csv') {
                $tools = $serializer->deserialize($file->getContents(),Tool::class.'[]','csv');
            }
            if ($file->getFileName() === 'risque.csv') {
                $risks = $serializer->deserialize($file->getContents(),Risk::class.'[]','csv');
            }
            if ($file->getFileName() === 'mesures.csv') {
                $measures = $serializer->deserialize($file->getContents(),Measure::class.'[]','csv');
            }
        }

        foreach ($situations as $situation) {
            foreach($situationGroups as $situationGroup) {
                if($situationGroup->getId() === $situation->getNumSituationGroup()){
                    $situationGroup->addSituation($situation);
                    $this->entityManager->persist($situationGroup);
                }
            }
            foreach ($tools as $tool) {
                if ($tool->getNumSituation() === $situation->getId()) {
                    $situation->addTool($tool);
                    $this->entityManager->persist($tool);
                }
            }
            foreach ($risks as $risk) {
                if ($risk->getNumSituation() === $situation->getId()) {
                    $situation->addRisks($risk);
                    $this->entityManager->persist($risk);
                }
            }
            $this->entityManager->persist($situation);
        }
        foreach ($risks as $risk) {
            foreach ($measures as $measure){
                if ($measure->getNumRisk() === $risk->getId()) {
                    $risk->addMeasures($measure);
                    $this->entityManager->persist($measure);
                }
            }
            $this->entityManager->persist($risk);
        }
        $this->entityManager->flush();
    }
}
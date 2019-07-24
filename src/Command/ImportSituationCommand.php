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

class ImportSituationCommand extends Command
{

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(?string $name = null, EntityManagerInterface $entityManager)
    {
        parent::__construct($name);
        $this->entityManager = $entityManager;
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
        $finder->files()->in(__DIR__.'/ImportFile');
        $serializer = new Serializer([new ArrayDenormalizer(), new GetSetMethodNormalizer()], [new CsvEncoder()]);
        foreach ($finder as $file) {
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
        $situationGroup = new SituationGroup();
        $situationGroup->setName('Test');
        $situationGroup->setDescr('Descr');

        foreach ($situations as $situation) {
            $situationGroup->addSituation($situation);
            foreach ($tools as $tool) {
                if ($tool->getNumSituation() === $situation->getId()) {
                    $situation->addTool($tool);
                    $this->entityManager->persist($tool);
                }
            }
            foreach ($risks as $risk) {
                if ($risk->getNumSituation() === $situation->getId()) {
                    $situation->addRisks($risk);
                }
            }
            $this->entityManager->persist($situation);
        }
        $this->entityManager->persist($situationGroup);
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
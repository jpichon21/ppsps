<?php
namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use App\Repository\SituationRepository;
use App\Repository\RiskRepository;
use App\Repository\SituationGroupRepository;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class SituationFormType extends AbstractType
{
    private $situationRepository;

    public function __construct(SituationRepository $situationRepository, RiskRepository $riskRepository, SituationGroupRepository $situationGroupRepository) {
        $this->situationRepository = $situationRepository;
        $this->situationGroupRepository = $situationGroupRepository;
        $this->riskRepository = $riskRepository;
    }
    
    public function getBlockPrefix()
    {
        return 'situationForm';
    }

    public static function getSubscribedEvents()
    {
        return [FormEvents::PRE_SET_DATA => 'preSetData'];
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $situationGroupList = $this->getSituationGroupChoiceList();
        if ($situationGroupList !== false) {
            $builder->add('situationGroup', ChoiceType::class, [
                'label' => 'Choix du type de situation',
                'choices' => $this->getSituationGroupChoiceList(),
            ]);
        }
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            $situationGroup = $event->getData()['situationGroup'];
            $form = $event->getForm();
            if (isset($event->getData()['situation'])) {
                $situation = $event->getData()['situation'];
            } else {
                $situation = null;
            }
            if ($situationGroup !== null) {
                $situationGroupList = $this->getSituationGroupChoiceList();               
                if ($situationGroupList !== false) {
                    $form->add('situationGroup', ChoiceType::class, [
                        'label' => 'Choix du type de situation',
                        'choices' => $situationGroupList,
                    ]);
                }
                if ($situation !== null) {
                    $situationList = $this->getSituationByGroupChoiceList($situationGroup);
                    if ($situationList !== false) {
                        $form->add('situation', ChoiceType::class, [
                            'label' => 'Choix de la situation de travail',
                            'choices' => $situationList,
                            // 'sonata_help' => $this->situationRepository->findById($situation)[0]->getDescr(),
                        ]);
                    }
                } else {
                    if ($this->getSituationByGroupChoiceList($situationGroup) !== false) {
                        $form->add('situation', ChoiceType::class, [
                            'label' => 'Choix de la situation de travail',
                            'choices' => $this->getSituationByGroupChoiceList($situationGroup),
                        ]);
                    }
                }
            }
            if($situation !== null) {
                $riskChoiceList = $this->getRiskListFromSituation($situation);
                if ($riskChoiceList !== false) {
                    $form->add('risk', ChoiceType::class, [
                        'label' => 'Risques associ??s',
                        'multiple' => true,
                        'expanded' => true,
                        'choices' => $riskChoiceList,
                    ]);
                }
            }
            if ($situation !== null) {
                $toolChoiceList = $this->getToolListFromSituation($situation);
                if ($toolChoiceList !== false) {
                    $form->add('tool', ChoiceType::class, [
                        'label' => 'Moyens/mat??riels concern??s',
                        'multiple' => true,
                        'expanded' => true,
                        'choices' => $toolChoiceList,
                    ]);
                }
            }
            if (isset($event->getData()['risk'])) {
                if($event->getData()['risk'] !== []){
                    $riskChoiceList = $this->getMeasureListFromRisk($event->getData()['risk']);
                    if ($riskChoiceList !== false) {
                        $form->add('measure', ChoiceType::class, [
                            'label' => 'Mesures prises en compte',
                            'multiple' => true,
                            'expanded' => true,
                            'choices' => $riskChoiceList,
                        ]);
                    }
                }
            }
        });
    }
    
    private function getSituationGroupChoiceList() {
        foreach ($this->situationGroupRepository->findAll() as $situationGroup) {
            if($situationGroup->getDeletedAt() === null) {
                $situationGroupChoiceList[$situationGroup->getName()] = $situationGroup->getId();
            }
        }
        if (isset($situationGroupChoiceList)) {
            return $situationGroupChoiceList;
        }
        return false;
    }

    private function getSituationByGroupChoiceList($situationGroupId) {
        $situationGroup = $this->situationGroupRepository->find($situationGroupId);
        if($situationGroup->getDeletedAt() === null) {
            foreach ($this->situationRepository->findBySituationGroup($situationGroup) as $situation) {
                $situationChoiceList[$situation->getName()] = $situation->getId();
            }
            if (isset($situationChoiceList)) {
                return $situationChoiceList;
            }
        }
        return false;
    }

    private function getRiskListFromSituation($situationId) {
        $situation = $this->situationRepository->find($situationId);
        if($situation->getDeletedAt() === null){
            foreach ($situation->getRisks() as $risk) {
                $riskChoiceList[$risk->getName()] = $risk->getId();
            }
            if (isset($riskChoiceList)) {
                return $riskChoiceList;
            }
        }
        return false;
    }

    private function getToolListFromSituation($situationId) {
        $situation = $this->situationRepository->find($situationId);
        if($situation->getDeletedAt() === null){
            foreach ($situation->getTools() as $tool) {
                $toolChoiceList[$tool->getName()] = $tool->getId();
            }
            if (isset($toolChoiceList)) {
                return $toolChoiceList;
            }
        }
        return false;
    }

    private function getMeasureListFromRisk($riskList) {
        foreach ($riskList as $risk) {
            $risk = $this->riskRepository->find($risk);
            if($risk !== null) {
                if($risk->getDeletedAt() === null){
                    foreach ($risk->getMeasures() as $measure) {
                        $measureChoiceList[$measure->getName()] = $measure->getId();
                    }
                }
            }
        }
        if (isset($measureChoiceList)) {
            return $measureChoiceList;
        }
        return false;
    }
}
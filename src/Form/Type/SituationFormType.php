<?php
namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use App\Repository\SituationRepository;
use App\Repository\RiskRepository;
use App\Entity\Situation;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class SituationFormType extends AbstractType
{
    private $situationRepository;

    public function __construct(SituationRepository $situationRepository, RiskRepository $riskRepository) {
        $this->situationRepository = $situationRepository;
        $this->riskRepository = $riskRepository;
    }
    
    public function getBlockPrefix()
    {
        return 'situationForm';
    }

    public static function getSubscribedEvents()
    {
        // Tells the dispatcher that you want to listen on the form.pre_set_data
        // event and that the preSetData method should be called.
        return [FormEvents::PRE_SET_DATA => 'preSetData'];
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('situation', ChoiceType::class, [
            'label' => 'Choix de la situation de travail',
            'choices' => $this->getSituationChoiceList(),
        ]);
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            $situation = $event->getData()['situation'];
            $form = $event->getForm();
            if ($situation !== null) {
                $riskChoiceList = $this->getRiskListFromSituation($situation);
                if ($riskChoiceList !== false) {
                    $form->add('risk', ChoiceType::class, [
                        'label' => 'Risque Potentiel',
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
                        'label' => 'Liste des outils concernés',
                        'multiple' => true,
                        'expanded' => true,
                        'choices' => $toolChoiceList,
                    ]);
                }
            }
            if (isset($event->getData()['risk'])) {
                if($event->getData()['risk'] !== []){
                    $form->add('measure', ChoiceType::class, [
                        'label' => 'Mesure pris en compte',
                        'multiple' => true,
                        'expanded' => true,
                        'choices' => $this->getMeasureListFromRisk($event->getData()['risk']),
                    ]);
                }
            }
        });
    }

    private function getSituationChoiceList() {
        foreach ($this->situationRepository->findAll() as $situation) {
            $situationChoiceList[$situation->getName()] = $situation->getId();
        }
        if (isset($situationChoiceList)) {
            return $situationChoiceList;
        }
        return false;
    }

    private function getRiskListFromSituation($situationId) {
        $situation = $this->situationRepository->find($situationId);
        foreach ($situation->getRisks() as $risk) {
            $riskChoiceList[$risk->getName()] = $risk->getId();
        }
        if (isset($riskChoiceList)) {
            return $riskChoiceList;
        }
        return false;
    }

    private function getToolListFromSituation($situationId) {
        $situation = $this->situationRepository->find($situationId);
        foreach ($situation->getTools() as $tool) {
            $toolChoiceList[$tool->getName()] = $tool->getId();
        }
        if (isset($toolChoiceList)) {
            return $toolChoiceList;
        }
        return false;
    }

    private function getMeasureListFromRisk($riskList) {
        foreach ($riskList as $risk) {
            $risk = $this->riskRepository->find($risk);
            foreach ($risk->getMeasures() as $measure) {
                $measureChoiceList[$measure->getName()] = $measure->getId();
            }
        }
        if (isset($measureChoiceList)) {
            return $measureChoiceList;
        }
        return false;
    }
}
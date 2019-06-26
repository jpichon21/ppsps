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

    public static function getSubscribedEvents()
    {
        // Tells the dispatcher that you want to listen on the form.pre_set_data
        // event and that the preSetData method should be called.
        return [FormEvents::PRE_SET_DATA => 'preSetData'];
    }


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('situation', ChoiceType::class, [
            'label' => 'Choix de la situation',
            'choices' => $this->getSituationChoiceList(),
        ]);
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            $situation = $event->getData()['situation'];
            $form = $event->getForm();
            if ($situation !== null) {
                $form->add('risk', ChoiceType::class, [
                    'label' => 'Risque Potentiel',
                    'multiple' => true,
                    'expanded' => true,
                    'choices' => $this->getRiskListFromSituation($situation),
                ]);
            }
            if (isset($event->getData()['risk'])) {
                if($event->getData()['risk'] !== []){
                    foreach ($this->getRiskListFromSituation($situation) as $index => $risk) {
                        if ($this->riskRepository->find($risk)->getMeasures()->getValues() !== []) {
                            $form->add('measure'.$index, ChoiceType::class, [
                                'label' => 'Mesure pris en considération',
                                'multiple' => true,
                                'expanded' => true,
                                'choices' => $this->getMeasureListFromRisk($risk)
                            ]);
                        }
                    }
                }
            }
        });
    }

    private function getSituationChoiceList() {
        foreach ($this->situationRepository->findAll() as $situation) {
            $situationChoiceList[$situation->getName()] = $situation->getId();
        }
        return $situationChoiceList;
    }

    private function getRiskListFromSituation($situationId) {
        $situation = $this->situationRepository->find($situationId);
        foreach ($situation->getRisks() as $risk) {
            $riskChoiceList[$risk->getName()] = $risk->getId();
        }
        return $riskChoiceList;
    }

    private function getMeasureListFromRisk($riskId) {
        $risk = $this->riskRepository->find($riskId);
        foreach ($risk->getMeasures() as $measure) {
            $measureChoiceList[$measure->getName()] = $measure->getId();
        }
        return $measureChoiceList;
    }
}
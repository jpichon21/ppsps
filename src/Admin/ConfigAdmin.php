<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use App\Form\Type\SituationFormType;
use Sonata\AdminBundle\Form\Type\CollectionType as SonataCollectionType;
use App\Form\Type\CollectionSituationFormType;

final class ConfigAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('situation', CollectionSituationFormType::class, [
            'allow_add' => true,
            'allow_delete' => true,
            'entry_type' => SituationFormType::class,
            'by_reference' => false,
        ],[
            'edit' => 'inline',
            'inline' => 'table',
        ]);

    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('situation');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('situation');
    }

    private function getSituationChoiceList() {
        foreach ($this->getConfigurationPool()->getContainer()->get('doctrine')->getRepository(Situation::class)->findAll() as $situation) {
            $situationChoiceList[$situation->getId()] = $situation->getName();
        }
        return $situationChoiceList;
    }
}
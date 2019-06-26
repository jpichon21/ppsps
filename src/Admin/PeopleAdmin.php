<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Sonata\CoreBundle\Form\Type\DateTimePickerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

final class PeopleAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('name', TextType::class, [
            'label' => 'Nom',
        ]);
        $formMapper->add('rank', ChoiceType::class, [
            'label' => 'Role',
            'choices' => [
                'Animateur Qualité Sécurité Environnement' => 'AQSE',
                'Directeur de Travaux' => 'workDirector',
                'Conducteur de travaux' => 'WorkManager',
                'Maitre compagnon' => 'masterCompanion',
                'Chef de chantier' => 'siteManager',
                'Chef d\'équipes' => 'leader',
            ]
        ]);
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('name');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('name');
    }
}
<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

final class EffectiveAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('business', TextType::class, [
            'label' => 'Entreprise'
        ]);
        $formMapper->add('average', IntegerType::class, [
            'label' => 'Moyen(nombre)'
        ]);
        $formMapper->add('maximum', IntegerType::class, [
            'label' => 'Maximum(nombre)'
        ]);
        $formMapper->add('peakPeriod', TextType::class, [
            'label' => 'Période de pointe(mois)'
        ]);
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('name');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        unset($this->listModes['mosaic']);
        $listMapper->addIdentifier('name');
    }
}
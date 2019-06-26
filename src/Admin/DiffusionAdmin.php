<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Sonata\Form\Type\DateTimePickerType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

final class DiffusionAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('recipient', TextType::class, [
            'label' => 'Destinataire'
        ]);
        $formMapper->add('name', IntegerType::class, [
            'label' => 'Nom'
        ]);
        $formMapper->add('date', DateTimePickerType::class, [
            'label' => 'Date',
            'dp_side_by_side'       => true,
            'dp_use_current'        => false,
            'dp_use_seconds'        => false,
            'dp_use_minutes'        => false,
            'dp_collapse'           => true,
            'dp_calendar_weeks'     => false,
            'dp_view_mode'          => 'days',
            'dp_min_view_mode'      => 'days',
            'required' => false,
        ]);
        $formMapper->add('paper', CheckboxType::class, [
            'label' => 'Papier'
        ]);
        $formMapper->add('numeric', CheckboxType::class, [
            'label' => 'numerique'
        ]);
        $formMapper->add('external', CheckboxType::class, [
            'label' => 'externe'
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
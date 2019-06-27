<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Sonata\Form\Type\DatePickerType;

final class UpdatePpspsAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('updateObject', TextType::class, [
            'label' => 'Objet de la modification',
            'required' => false
        ]);
        $formMapper->add('indexUpdate', IntegerType::class, [
            'label' => 'Indice',
            'required' => false
        ]);
        $formMapper->add('updateDate', DatePickerType::class, [
            'label' => 'Date',
            'dp_side_by_side'       => true,
            'dp_use_current'        => false,
            'dp_collapse'           => true,
            'dp_calendar_weeks'     => false,
            'dp_view_mode'          => 'days',
            'dp_min_view_mode'      => 'days',
            'required' => false,
        ]);
        $formMapper->add('writeBy', TextType::class, [
            'label' => 'Réaliser par',
            'required' => false
        ]);
        $formMapper->add('aprovedBy', TextType::class, [
            'label' => 'Validé Par',
            'required' => false
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
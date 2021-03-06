<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Sonata\Form\Type\DatePickerType;
use Sonata\AdminBundle\Route\RouteCollection;

final class DealerAdmin extends AbstractAdmin
{
    public function configureRoutes(RouteCollection $collection) {
        $collection->remove('export');
    }
    
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('name', TextType::class, [
            'label' => 'Nom'
        ]);
        $formMapper->add('mail', TextType::class, [
            'label' => 'Email'
        ]);
        $formMapper->add('sendingDate', DatePickerType::class, [
            'label' => 'DICT envoyée le',
            'dp_side_by_side'       => true,
            'dp_use_current'        => false,
            'dp_collapse'           => true,
            'dp_calendar_weeks'     => false,
            'dp_view_mode'          => 'days',
            'dp_min_view_mode'      => 'days',
            'required' => false,
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
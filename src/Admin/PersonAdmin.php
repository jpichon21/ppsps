<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Sonata\AdminBundle\Route\RouteCollection;

final class PersonAdmin extends AbstractAdmin
{
    public function configureRoutes(RouteCollection $collection) {
        $collection->remove('export');
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('name', TextType::class, ['label' => 'nom'])
        ->add('company', TextType::class, ['label' => 'Contact', 'required' => false])
        ->add('address', TextType::class, ['label' => 'Adresse', 'required' => false])
        ->add('fax', TextType::class, ['label' => 'Fax', 'required' => false])
        ->add('email', TextType::class, ['label' => 'Email', 'required' => false])
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('name');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        unset($this->listModes['mosaic']);
        $listMapper->add('name', null, ['label' => 'nom'])
        ->add('company', null, ['label' => 'Contact'])
        ->add('address', null, ['label' => 'Adresse'])
        ->add('fax', null, ['label' => 'Fax'])
        ->add('email', null, ['label' => 'Email']);
        $listMapper->add('_action', null, [
            'actions' => [
                'edit' => [],
                'delete' => [],
            ]
        ]);
    }
}
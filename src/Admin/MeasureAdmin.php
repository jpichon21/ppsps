<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\AdminBundle\Route\RouteCollection;

final class MeasureAdmin extends AbstractAdmin
{
    public function configureRoutes(RouteCollection $collection) {
        $collection->remove('export');
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('name', TextType::class, [
            'label' => 'Nom'
        ]);
        $formMapper->add('descr', TextareaType::class, [
            'label' => 'Description'
        ]);
        $formMapper->add('Risk', ModelType::class , array(
            'class' => 'App\Entity\Risk',
            'multiple' => false, 
            'by_reference' => false,
            'label'=>'Choissisez les risques associés a cette mesure'));
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('risk', null, [
            'label' => 'Risque'
        ]);
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        unset($this->listModes['mosaic']);
        $listMapper->add('name', null, [
            'label' => 'Nom'
        ]);
        $listMapper->add('descr', null, [
            'label' => 'Description'
        ]);
        $listMapper->add('risk', null, [
            'label' => 'Risque'
        ]);
        $listMapper->add('_action', null, [
            'actions' => [
                'edit' => [],
                'delete' => [],
            ]
        ]);
    }

    public function createQuery($context = 'list')
    {
        $query = parent::createQuery($context);
        $query->orderBy('o.risk');
        return $query;
    }
}
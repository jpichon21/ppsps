<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Form\Type\ModelType;

final class SituationAdmin extends AbstractAdmin
{
    public function configureRoutes(RouteCollection $collection) {
        $collection->remove('export');
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->with('Situation de travail');
        $formMapper->add('name', TextType::class, [
            'label' => 'Nom'
        ]);
        $formMapper->add('descr', TextareaType::class, [
            'label' => 'Description'
        ]);
        $formMapper->add('SituationGroup', ModelType::class , array(
            'class' => 'App\Entity\SituationGroup',
            'multiple' => false, 
            'by_reference' => false,
            'label'=>'Choissisez le groupe de la situation de travail'));
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('name');
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
        $query->where($query->expr()->isNull($query->getRootAliases()[0] . '.deletedAt'));
        return $query;
    }

}
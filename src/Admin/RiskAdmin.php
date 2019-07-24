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

final class RiskAdmin extends AbstractAdmin
{
    public function configureRoutes(RouteCollection $collection) {
        $collection->remove('export');
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->with('Risque associé');
        $formMapper->add('name', TextType::class, [
            'label' => 'Nom'
        ]);
        $formMapper->add('descr', TextareaType::class, [
            'label' => 'Description'
        ]);
        $formMapper->add('Situation', ModelType::class , array(
            'class' => 'App\Entity\Situation',
            'multiple' => false, 
            'by_reference' => false,
            'label'=>'Choissisez la situation de travail associée à ce risque'));
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('situation', null, [
            'label' => 'Situation de travail'
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
        $listMapper->add('situation', null, [
            'label' => 'Situation de travail'
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
        $query->orderBy('o.situation');
        return $query;
    }

}
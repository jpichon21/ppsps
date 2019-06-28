<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Sonata\AdminBundle\Form\Type\ModelType;

final class ToolAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('name', TextType::class);
        $formMapper->add('descr', TextareaType::class);
        $formMapper->add('situation', ModelType::class , array(
            'class' => 'App\Entity\Situation',
            'multiple' => false, 
            'by_reference' => false,
            'label'=>'Choissisez les outils associés a cette mesure'));
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('situation', null, [
            'label' => 'Situation'
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
            'label' => 'Situation'
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
        $query->orderBy('o.situation');
        return $query;
    }
}
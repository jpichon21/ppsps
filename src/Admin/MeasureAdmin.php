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
        $formMapper->with('Mesure');
        $formMapper->add('name', TextType::class, [
            'label' => 'Nom'
        ]);
        $formMapper->add('Risk', ModelType::class , array(
            'class' => 'App\Entity\Risk',
            'multiple' => false, 
            'by_reference' => false,
            'label'=>'Choissise le risque associé à cette mesure'));
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('risk', null, [
            'label' => 'Risque associé'
        ]);
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        unset($this->listModes['mosaic']);
        $listMapper->add('name', null, [
            'label' => 'Nom'
        ]);
        $listMapper->add('risk', null, [
            'label' => 'Risque associé'
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
        $query->orderBy('o.risk');
        return $query;
    }
}
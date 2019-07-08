<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use App\Form\Type\SituationFormType;
use Sonata\AdminBundle\Form\Type\CollectionType as SonataCollectionType;
use App\Form\Type\CollectionSituationFormType;
use Sonata\AdminBundle\Route\RouteCollection;

use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class AnnexAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name', TextType::class, [
                'label' => 'Nom du fichier',
                'required' => true
            ])
            ->add('file', FileType::class, [
                'label' => 'Fichier',
                'required' => false
            ])
        ;
    }

    public function prePersist($annex)
    {
        $this->manageFileUpload($annex);
    }

    public function preUpdate($annex)
    {
        $this->manageFileUpload($annex);
    }

    private function manageFileUpload($annex)
    {
        if ($annex->getFile()) {
            $annex->upload();
            $annex->refreshUpdated();
        }
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('id');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        unset($this->listModes['mosaic']);
        $listMapper->addIdentifier('id');
    }
}
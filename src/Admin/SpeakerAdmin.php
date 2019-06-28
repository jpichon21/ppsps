<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Sonata\CoreBundle\Form\Type\DateTimePickerType;

final class SpeakerAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('name', TextType::class, [
            'label' => 'Nom'
        ]);
        $formMapper->add('contact', TextType::class, [
            'label' => 'Contact'
        ]);
        $formMapper->add('address', TextType::class, [
            'label' => 'Adresse'
        ]);
        $formMapper->add('fax', TextType::class, [
            'label' => 'Fax'
        ]);
        $formMapper->add('mail', TextType::class, [
            'label' => 'Email'
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
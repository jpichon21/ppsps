<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Symfony\Component\Validator\Constraints\File;

final class PpspsImageAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name', TextType::class, [
                'label' => 'Nom du fichier',
                'required' => true,
                'sonata_help' => 'Veuillez insérer une image au format jpeg, Jpg, pjpeg ou Png d\'une taille maximum de 2 Mo'
            ]);               
        $formMapper
            ->add('imageFile', VichFileType::class, [
                'label' => 'Fichier',
                'required' => true,
                'allow_delete'  => false, 
                'download_link' => false,
                'attr' => [
                    'accept' => "image/jpeg, image/jpg, image/pjpeg, image/png, image/x-png"
                ],
                'constraints' => [
                    new File([
                        'maxSize' => '2M',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/jpg',
                            'image/pjpeg',
                            'image/png',
                            'image/x-png',
                        ],
                        'mimeTypesMessage' => 'Please upload an image file',
                    ])
                ]
        ]);       
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('name');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        unset($this->listModes['mosaic']);
        $listMapper
        ->add('name')
        ->add('image', null, [
            'label' => 'Miniature',
            'template' => 'admin/field/thumbnail.html.twig'            
        ])
        ->add('_action', null, [
            'actions' => [
                'edit' => [],
                'delete' => [],
            ]
        ]);
    }
}
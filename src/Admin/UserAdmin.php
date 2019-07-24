<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Sonata\AdminBundle\Form\Type\ModelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class UserAdmin extends AbstractAdmin
{
    public function configureRoutes(RouteCollection $collection) {
        $collection->remove('export');
    }

    public function prePersist($object)
    {
        $this->preUpdate($object);
    }

    public function preUpdate($object)
    {
        $plainPassword = $object->getPlainPassword();
        if ($plainPassword !== null) {
            $container = $this->getConfigurationPool()->getContainer();
            $encoder = $container->get('security.password_encoder');
            $encoded = $encoder->encodePassword($object, $plainPassword);
        
            $object->setPassword($encoded);
        }
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('roles', ChoiceType::class, [
            'label' => 'Roles',
            'choices' => User::ROLES,
            'multiple' => true,
            'expanded' => true,
        ]);
        $formMapper->add('name', TextType::class, [
            'label' => 'Nom',
            'required' => true,
        ]);
        $formMapper->add('email', EmailType::class, [
            'label' => 'Email',
            'required' => true,
        ]);
        if ($this->isCurrentRoute('edit')) {
            $formMapper
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => ['label' => 'Mot de passe'],
                'second_options' => ['label' => 'Répéter le mot de passe'],
                'required' => false
            ]);
        } else {
            $formMapper
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => ['label' => 'Mot de passe'],
                'second_options' => ['label' => 'Répéter le mot de passe'],
                'required' => true
            ]);
        }
        $formMapper->add('groupment', ModelType::class, [
            'label' => 'Groupe',
            'required' => true,
            'btn_add' => false,
        ]);
        
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('email');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        unset($this->listModes['mosaic']);
        $listMapper->add('name', null, [
            'label' => 'Nom'
        ]);
        $listMapper->add('email', null, [
            'label' => 'Email'
        ]);
        $listMapper->add('_action', null, [
            'actions' => [
                'edit' => [],
                'delete' => [],
            ]
        ]);
    }
}
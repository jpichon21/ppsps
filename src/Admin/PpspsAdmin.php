<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Sonata\Form\Type\DatePickerType;
use Sonata\Form\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Sonata\AdminBundle\Form\Type\ModelType;
use App\Form\Type\SituationFormType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType as SymfonyCollectionType;

final class PpspsAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Configuration générale')
                ->add('siteName', TextType::class, [
                    'label' => 'Nom du chantier',
                    'required' => false
                ])
                ->add('siteNumber', IntegerType::class, [
                    'label' => 'Numéro du chantier',
                    'required' => false 
                ])
                ->add('globalSiteAddress', TextType::class, [
                    'label' => 'Adresse du chantier',
                    'required' => false
                ])
                ->add('periodOfExecution', TextType::class, [
                    'label' => 'Période d\'execution',
                    'required' => false
                ])        
                ->add('owner', TextType::class, [
                    'label' => 'Maitre de l\'ouvrage',
                    'required' => false
                ])
                ->add('projectManager', TextType::class, [
                    'label' => 'Maitre d\'oeuvre',
                    'required' => false
                ])
                ->add('diffusions', CollectionType::class, [
                    'label' => 'Configurations du tableau des diffusion',
                    'required' => false,
                    'by_reference' => false,
                    'type_options' => [
                        'delete' => true,
                    ],
                ], [
                    'edit' => 'inline',
                    'inline' => 'table',
                ])
                ->add('updatesPpsps', CollectionType::class, [
                    'label' => 'Configurations du tableau de mises à jour',
                    'required' => false,
                    'by_reference' => false,
                    'type_options' => [
                        'delete' => true,
                    ],
                ], [
                    'edit' => 'inline',
                    'inline' => 'table',
                ])
            ->end()
            ->with('Identification des traveaux')
                ->add('AddressConstrSite', TextType::class, [
                    'label' => 'Adresse du chantier',
                    'required' => false
                ])
                ->add('AddressAccessSite', TextType::class, [
                    'label' => 'Adresse d\'accès au chantier',
                    'required' => false
                ])
                ->add('referent', TextType::class, [
                    'label' => 'Personne référente sur site',
                    'required' => false
                ])
                ->add('referentPhone', TextType::class, [
                    'label' => 'Téléphone',
                    'required' => false
                ])
                ->add('referentMail', TextType::class, [
                    'label' => 'Mail',
                    'required' => false
                ])
            ->end()
            ->with('Description des travaux')
                ->add('siteType', ChoiceType::class, [
                    'label' => 'L\'entreprise intervient sur le chantier en tant que :',
                    'choices' => [
                        'Titulaire exclusif' => 'exclusif',
                        'Co-titulaire' => 'co-titular',
                        'Sous-traitant de l\'Entreprise' => 'subcontractor',
                        'Groupement intégré - Mandataire' => 'mandatory'
                    ],
                    'required' => false
                ])
                ->add('mandatoryDescr', TextType::class, [
                    'label' => 'Description groupement intégré - Mandataire',
                    'required' => false
                ])
                ->add('descrWork', TextareaType::class, [
                    'label' => 'Description des travaux propres à ROUGEOT (ou du Groupement)',
                    'required' => false 
                ])
                ->add('subWorkDescr', TextareaType::class, [
                    'label' => 'Traveaux sous-traites envisage',
                    'required' => false
                ])
            ->end()
            ->with('Calendrier des travaux')
                ->add('dateBegin', DatePickerType::class, [
                    'label' => 'Date de début prévu du chantier',
                    'dp_side_by_side'       => true,
                    'dp_use_current'        => false,
                    'dp_collapse'           => true,
                    'dp_calendar_weeks'     => false,
                    'dp_view_mode'          => 'days',
                    'dp_min_view_mode'      => 'days',
                    'required' => false,
                ])
                ->add('dateEnd', DatePickerType::class, [
                    'label' => 'Date de fin prévu du chantier',
                    'dp_side_by_side'       => true,
                    'dp_use_current'        => false,
                    'dp_collapse'           => true,
                    'dp_calendar_weeks'     => false,
                    'dp_view_mode'          => 'days',
                    'dp_min_view_mode'      => 'days',
                    'required' => false,
                ])
                ->add('rest', ChoiceType::class, [
                    'label' => 'Arrèts de chantier',
                    'choices' => [
                        'Congés été' => 'summer-rest',
                        'Congés Hiver' => 'winter-rest',
                        'Autre' => 'other',
                    ],
                    'multiple' => true,
                    'expanded' => true,
                    'required' => false
                ])
                ->add('winterRestBegin', DatePickerType::class, [
                    'label' => 'Date de début des congés d\'hiver',
                    'dp_side_by_side'       => true,
                    'dp_use_current'        => false,
                    'dp_collapse'           => true,
                    'dp_calendar_weeks'     => false,
                    'dp_view_mode'          => 'days',
                    'dp_min_view_mode'      => 'days',
                    'required' => false,
                ])
                ->add('winterRestEnd', DatePickerType::class, [
                    'label' => 'Date de fin des congés d\'hiver',
                    'dp_side_by_side'       => true,
                    'dp_use_current'        => false,
                    'dp_collapse'           => true,
                    'dp_calendar_weeks'     => false,
                    'dp_view_mode'          => 'days',
                    'dp_min_view_mode'      => 'days',
                    'required' => false,
                ])
                ->add('summerRestBegin', DatePickerType::class, [
                    'label' => 'Date de début des congés d\'été',
                    'dp_side_by_side'       => true,
                    'dp_use_current'        => false,
                    'dp_collapse'           => true,
                    'dp_calendar_weeks'     => false,
                    'dp_view_mode'          => 'days',
                    'dp_min_view_mode'      => 'days',
                    'required' => false,
                ])
                ->add('summerRestEnd', DatePickerType::class, [
                    'label' => 'Date de fin des congés d\'été',
                    'dp_side_by_side'       => true,
                    'dp_use_current'        => false,
                    'dp_collapse'           => true,
                    'dp_calendar_weeks'     => false,
                    'dp_view_mode'          => 'days',
                    'dp_min_view_mode'      => 'days',
                    'required' => false,
                ])
                ->add('otherRestBegin', DatePickerType::class, [
                    'label' => 'Date de début des autres congés',
                    'dp_side_by_side'       => true,
                    'dp_use_current'        => false,
                    'dp_collapse'           => true,
                    'dp_calendar_weeks'     => false,
                    'dp_view_mode'          => 'days',
                    'dp_min_view_mode'      => 'days',
                    'required' => false,
                ])
                ->add('otherRestEnd', DatePickerType::class, [
                    'label' => 'Date de fin des autres congés',
                    'dp_side_by_side'       => true,
                    'dp_use_current'        => false,
                    'dp_collapse'           => true,
                    'dp_calendar_weeks'     => false,
                    'dp_view_mode'          => 'days',
                    'dp_min_view_mode'      => 'days',
                    'required' => false,
                ])
                ->add('openingSite', DatePickerType::class, [
                    'label' => 'déclaration d\'Ouverture de chantier',
                    'dp_side_by_side'       => true,
                    'dp_use_current'        => false,
                    'dp_collapse'           => true,
                    'dp_calendar_weeks'     => false,
                    'dp_view_mode'          => 'days',
                    'dp_min_view_mode'      => 'days',
                    'required' => false,
                ])
                ->add('startingWork', DatePickerType::class, [
                    'label' => 'déclaration d\'Intention de commencer les Travaux (D.I.C.T.)',
                    'dp_side_by_side'       => true,
                    'dp_use_current'        => false,
                    'dp_collapse'           => true,
                    'dp_calendar_weeks'     => false,
                    'dp_view_mode'          => 'days',
                    'dp_min_view_mode'      => 'days',
                    'required' => false,
                ])
            ->end()
            ->with('Concessionaire')
                ->add('dealers', CollectionType::class, [
                    'label' => 'Concessionaire',
                    'required' => false,
                    'by_reference' => false,
                    'type_options' => [
                        'delete' => true,
                    ],
                ], [
                    'edit' => 'inline',
                    'inline' => 'table',
                ])
            ->end()
            ->with('Organisation de l\'entreprise (ou du groupement)')
                ->add('AQSE', TextType::class, [
                    'label' => 'Animateur Qualité Sécurité Environnement',
                    'required' => false
                ])
                ->add('workDirector', TextType::class, [
                    'label' => 'Directeur de Travaux',
                    'required' => false
                ])
                ->add('workDirectors', CollectionType::class, [
                    'label' => 'Conducteur(s) de Travaux',
                    'required' => false,
                    'by_reference' => false,
                    'type_options' => [
                        'delete' => true,
                    ],
                ], [
                    'edit' => 'inline',
                    'inline' => 'table',
                ])
                ->add('masterCompanion', TextType::class, [
                    'label' => 'Maitre compagnon',
                    'required' => false
                ])
                ->add('siteManagers', CollectionType::class, [
                    'label' => 'Chef(s) de chantier',
                    'required' => false,
                    'by_reference' => false,
                    'type_options' => [
                        'delete' => true,
                    ],
                ], [
                    'edit' => 'inline',
                    'inline' => 'table',
                ])
                ->add('leaders', CollectionType::class, [
                    'label' => 'Chef(s) d\'équipe',
                    'required' => false,
                    'by_reference' => false,
                    'type_options' => [
                        'delete' => true,
                    ],
                ], [
                    'edit' => 'inline',
                    'inline' => 'table',
                ])
            ->end()
            ->with('Intervenants')
                ->add('speakers', CollectionType::class, [
                    'label' => 'Intervenant',
                    'required' => false,
                    'by_reference' => false,
                    'type_options' => [
                        'delete' => true,
                    ],
                ], [
                    'edit' => 'inline',
                    'inline' => 'table',
                ])
            ->end()
            ->with('C.I.S.S.T.')
                ->add('myCissct', ChoiceType::class, [
                    'label' => 'Obligation',
                    'choices' => [
                        'Oui' => 'Oui',
                        'Non' => 'Non',
                        'Non applicable (activités VRD, menuiserie, éléctricité' => 'Non applicable (activités VRD, menuiserie, éléctricité',
                    ],
                    'required' => false,
                    'expanded' => true,
                ])
                ->add('chiefWorkRepresentative', TextType::class, [
                    'label' => 'Répresentant sur le chantier',
                    'required' => false
                ])
            ->end()
            ->with('Effectif')
                ->add('effectives', CollectionType::class, [
                    'label' => false,
                    'required' => false,
                    'by_reference' => false,
                    'type_options' => [
                        'delete' => true,
                    ],
                ], [
                    'edit' => 'inline',
                    'inline' => 'table',
                ])
            ->end()
            ->with('Hygiène,santé et sécurité au travail')
                ->add('securityCoordinator', CheckboxType::class, [
                    'label'=> 'Coordonateur sécurité',
                    'required' => false
                ])
                ->add('PGC', CheckboxType::class, [
                    'label'=> 'PGC',
                    'required' => false
                ])
                ->add('inspectionVisit', CheckboxType::class, [
                    'label'=> 'Visite d\'inspection commune',
                    'required' => false
                ])
                ->add('securityCoordinatorName', TextType::class, [
                    'label' => 'Nom du coordinateur sécurité',
                    'required' => false
                ])
                ->add('PGCRef', TextType::class, [
                    'label' => 'Réference du PGC',
                    'required' => false
                ])
                ->add('PGCDate', DatePickerType::class, [
                    'label' => 'Date PGC',
                    'dp_side_by_side'       => true,
                    'dp_use_current'        => false,
                    'dp_collapse'           => true,
                    'dp_calendar_weeks'     => false,
                    'dp_view_mode'          => 'days',
                    'dp_min_view_mode'      => 'days',
                    'required' => false,
                ])
                ->add('inspectionVisitDate', DatePickerType::class, [
                    'label' => 'Date de la visite d\'inspection commune',
                    'dp_side_by_side'       => true,
                    'dp_use_current'        => false,
                    'dp_collapse'           => true,
                    'dp_calendar_weeks'     => false,
                    'dp_view_mode'          => 'days',
                    'dp_min_view_mode'      => 'days',
                    'required' => false,
                ])
            ->end()
            ->with('Innventaires des instalations Rougeot ou groupement d\'entreprise')
                ->add('listOfInstallations', ChoiceType::class, [
                    'label' => false,
                    'choices' => [
                        'Bureau de chantier' => 'Bureau de chantier',
                        'Vestiaire' => 'Vestiaire',
                        'Réféctoire' => 'Réféctoire',
                        'WC' => 'WC',
                        'Lavabos' => 'Lavabos',
                        'Douche' => 'Douche',
                        'Préfabriqué' => 'Préfabriqué',
                    ],
                    'multiple' => true,
                    'expanded' => true,
                ])
                ->add('otherInstalation', TextType::class, [
                    'label' => 'Autre',
                    'required' => false
                ])
                ->add('maintainer', CheckboxType::class, [
                    'label'=> 'Maintenu par ROUGEOT',
                    'required' => false
                ])
                ->add('otherMaintainer', TextType::class, [
                    'label' => 'Maintenu par',
                    'required' => false
                ])
                ->add('accomodation', CheckboxType::class, [
                    'label'=> 'Hébergement du personnel sur chantier',
                    'required' => false
                ])
                ->add('accomodationDescr', TextAreaType::class, [
                    'label' => 'Commentaire',
                    'required' => false
                ])
            ->end()
            ->with('Aptitudes particulières du personnel affecté au chantier')
                ->add('suiabilityList', ChoiceType::class, [
                    'label' => false,
                    'choices' => [
                        'H0/B0V' => 'H0/B0V',
                        'H1/B1T' => 'H1/B1T',
                        'H2/B2T' => 'H2/B2T',
                        'Grutier' => 'Grutier',
                        'F.I.M.O.' => 'F.I.M.O.',
                        'F.C.O.' => 'F.C.O.',
                        'Conduite d\'engins' => 'Conduite d\'engins',
                        'Conduite de nacelles élévatrices ou P.E.M.P.' => 'Conduite de nacelles élévatrices ou P.E.M.P.',
                        'Utilisation d\'explosifs CPT' => 'Utilisation d\'explosifs CPT',
                        'Travail en égout CATE 2' => 'Travail en égout CATE 2',
                        'Echafaudage: montage/démontage' => 'Echafaudage: montage/démontage',
                        'Echafaudage: réception' => 'Echafaudage: réception',
                        'Harnais' => 'Harnais',
                    ],
                    'multiple' => true,
                    'expanded' => true,
                ])
                ->add('suiability', TextType::class, [
                    'label' => 'Autre aptitude',
                    'required' => false
                ])
            ->end()
            ->with('Mesure Générales de préventions')
                ->add('mandatoryDocument', ChoiceType::class, [
                    'label' => false,
                    'choices' => [
                        'Registre unique de sécurité' => 'Registre unique de sécurité',
                        'Registre d\'observations' => 'Registre d\'observations',
                        'Registre du personnel sur chantier' => 'Registre du personnel sur chantier',
                        'Registre des avis de dangers grave et imminent' => 'Registre des avis de dangers grave et imminent',
                        'PV de contrôle installation grue' => 'PV de contrôle installation grue',
                        'PV de contrôle installation électrique' => 'PV de contrôle installation électrique',
                        'Permis de démolir' => 'Permis de démolir',
                        'Autorisation de voirie' => 'Autorisation de voirie',
                        'Arrêté de circulation' => 'Arrêté de circulation',
                    ],
                    'multiple' => true,
                    'expanded' => true,
                ])
                ->add('particularSecurityDetail', TextType::class, [
                    'label' => 'Détail des mesure particulière',
                    'required' => false
                ])
            ->end()
            ->with('Analyse des risques')
                ->add('situation', SymfonyCollectionType::class, [
                    'allow_add' => true,
                    'allow_delete' => true,
                    'entry_type' => SituationFormType::class,
                    'by_reference' => false
                ],[
                    'edit' => 'inline',
                    'inline' => 'table',
                ])
            ->end()
        ;

    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('AddressConstrSite');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('name');
    }
}
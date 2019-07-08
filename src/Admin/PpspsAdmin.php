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
use App\Form\Type\SituationFormType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType as SymfonyCollectionType;
use Sonata\DoctrineORMAdminBundle\Filter\ChoiceFilter;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Form\Type\ModelAutocompleteType;

final class PpspsAdmin extends AbstractAdmin
{
    public function configureRoutes(RouteCollection $collection) {
        $collection->remove('export');
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->tab('Configuration du Ppsps')
                ->with('État du document')
                    ->add('status', ChoiceType::class, [
                        'label' => false,
                        'choices' => [
                            'Brouillon' => 'Brouillon',
                            'Validé' => 'Validé',
                            'Archivé' => 'Archivé',
                        ],
                        'required' => true
                    ])
                ->end()
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
                        'label' => 'Maître d\'ouvrage',
                        'required' => false
                    ])
                    ->add('projectManager', TextType::class, [
                        'label' => 'Maître d\'oeuvre',
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
                        'label' => 'Téléphone du référent',
                        'required' => false
                    ])
                    ->add('referentMail', TextType::class, [
                        'label' => 'Mail du référent',
                        'required' => false
                    ])
                    ->add('diffusions', CollectionType::class, [
                        'label' => 'Configuration du tableau des diffusions',
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
                        'label' => 'Configuration du tableau de mise à jour',
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
                    ->add('subcontractedWorks', CollectionType::class, [
                        'label' => 'Travaux sous-traités envisagés',
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
                        'label' => 'Arrêt de chantier',
                        'choices' => [
                            'Congés été' => 'summer-rest',
                            'Congés Hiver' => 'winter-rest',
                            'Autre' => 'other',
                        ],
                        'multiple' => true,
                        'expanded' => true,
                        'required' => false
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
                        'label' => 'Déclaration d\'ouverture de chantier',
                        'dp_side_by_side'       => true,
                        'dp_use_current'        => false,
                        'dp_collapse'           => true,
                        'dp_calendar_weeks'     => false,
                        'dp_view_mode'          => 'days',
                        'dp_min_view_mode'      => 'days',
                        'required' => false,
                    ])
                    ->add('startingWork', DatePickerType::class, [
                        'label' => 'Déclaration d\'intention de commencer les travaux (D.I.C.T.)',
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
                    ->add('workDirectors', ModelAutocompleteType::class, [
                        'label' => 'Conducteur(s) de Travaux',
                        'required' => false,
                        'multiple' => true,
                        'property' => 'name'
                    ])
                    ->add('masterCompanion', ModelAutocompleteType::class, [
                        'label' => 'Maître compagnon',
                        'required' => false,
                        'property' => 'name'
                    ])
                    ->add('siteManagers', ModelAutocompleteType::class, [
                        'label' => 'Chef(s) de chantier',
                        'property' => 'name',
                        'required' => false,
                        'multiple' => true
                    ])
                    ->add('leaders', ModelAutocompleteType::class, [
                        'label' => 'Chef(s) d\'équipe',
                        'property' => 'name',
                        'required' => false,
                        'multiple' => true
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
                ->with('Intervenants suplémentaires')
                    ->add('speakers', CollectionType::class, [
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
                ->with('C.I.S.S.T.')
                    ->add('myCissct', CheckboxType::class, [
                        'label'=> 'Obligation',
                        'required' => false
                    ])
                    ->add('chiefWorkRepresentative', TextType::class, [
                        'label' => 'Représentant de l\'entreprise au CISST',
                        'required' => false
                    ])
                ->end()
                ->with('Coordination SPS')
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
                    ->add('siteLevel', ChoiceType::class, [
                        'label'=> 'Niveau de chantier',
                        'choices' => [
                            'Niveau 1' => 'Niveau 1',
                            'Niveau 2' => 'Niveau 2',
                            'Niveau 3' => 'Niveau 3',
                        ],
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
                ->with('Installations de chantier')
                    ->add('listOfInstallations', ChoiceType::class, [
                        'label' => false,
                        'choices' => [
                            'Installation mobile équipée' => 'Installation mobile équipée',
                            'WC raccordé' => 'WC raccordé',
                            'WC non raccordé' => 'WC non raccordé',
                            'Installation fixe' => 'Installation fixe',
                            'Bureau de chantier' => 'Bureau de chantier',
                            'Vestiaire' => 'Vestiaire',
                            'Réfectoire' => 'Réfectoire',
                            'Lavabos' => 'Lavabos',
                            'Douche' => 'Douche',
                        ],
                        'multiple' => true,
                        'expanded' => true,
                    ])
                    ->add('otherInstalation', TextType::class, [
                        'label' => 'Autre',
                        'required' => false
                    ])
                    ->add('maintainer', TextType::class, [
                        'label' => 'Maintenu et entretenu par l\'entreprise',
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
                ->with('Documents oligatoires')
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
                        'label' => 'Détail des mesures particulières',
                        'required' => false
                    ])
                ->end()
                ->with('Liste d\'annexes')
                    ->add('annexs', CollectionType::class, [
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
            ->end()
            ->tab('Configuration de l\'analyse des risques')
                ->with('Analyse des risques')
                    ->add('situation', SymfonyCollectionType::class, [
                        'allow_add' => true,
                        'allow_delete' => true,
                        'entry_type' => SituationFormType::class,
                        'by_reference' => false,
                        'label' => false,
                        'required' => false
                    ],[
                        'edit' => 'inline',
                        'inline' => 'table',
                    ])
                ->end()
            ->end()
        ;

    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('siteNumber', null, [
            'label' => 'Numéro du chantier'
        ]);
        $datagridMapper->add('status', ChoiceFilter::class, [
            'label' => 'Etat du document',
            'choices' => [
                'Brouillon' => 'Brouillon',
                'Validé' => 'Validé',
                'Archivé' => 'Archivé',
            ],
        ]);
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        unset($this->listModes['mosaic']);
        $listMapper->add('siteName', null, [
            'label' => 'Nom du chantier'
        ]);
        $listMapper->add('siteNumber', null, [
            'label' => 'Numéro du chantier'
        ]);
        $listMapper->add('globalSiteAddress', null, [
            'label' => 'Adresse du chantier'
        ]);        
        $listMapper->add('periodOfExecution', null, [
            'label' => 'Période d\'éxecution'
        ]);
        $listMapper->add('owner', null, [
            'label' => 'Maître d\'ouvrage',
        ]);
        $listMapper->add('projectManager', null, [
            'label' => 'Maître d\'oeuvre',
        ]);
        $listMapper->add('status', ChoiceType::class, [
            'label' => 'Etat du document',
        ]);
        $listMapper->add('_action', null, [
            'actions' => [
                'edit' => [],
                'delete' => [],
                'export' => ['template' => 'admin/action/export.html.twig']
            ]
        ]);
    }
}
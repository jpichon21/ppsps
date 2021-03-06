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
use App\Entity\SituationGroup;
use App\Entity\Situation;
use Sonata\AdminBundle\Form\Type\ModelType;

final class PpspsAdmin extends AbstractAdmin
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
        $situationLists = $object->getSituation();
        foreach ($situationLists as $key => $situation) {
            if(isset($situation['situationGroup'])){
                if(isset($situation['situation'])){
                    if(!$this->checkIntegritySituation($situation['situationGroup'], $situation['situation'])){
                        unset($situationLists[$key]['situation']);
                        unset($situationLists[$key]['risk']);
                        unset($situationLists[$key]['tool']);
                        unset($situationLists[$key]['measure']);
                    }
                    if(isset($situation['risk'])) {
                        if ($situation['risk'] === null || $situation['risk'] === []) {
                            unset($situationLists[$key]['measure']);
                        }
                        foreach ($situation['risk'] as $risk) {
                            if(!$this->checkIntegrityRisk($situation['situation'], $risk)){
                                unset($situationLists[$key]['risk']);
                                break;
                            }
                        }
                    }
                    if(isset($situation['tool'])) {
                        foreach ($situation['tool'] as $tool) {
                            if(!$this->checkIntegrityTool($situation['situation'], $tool)){
                                unset($situationLists[$key]['tool']);
                                break;
                            }
                        }
                    }
                }
            }
        }
        $object->setSituation($situationLists);
        if ($object->getGroupment() === null) {
            $object->setGroupment($this->getUser()->getGroupment());
        }
    }

    private function checkIntegritySituation($situationGroupId, $situationId) {
        $em =  $this->getConfigurationPool()->getContainer()->get('doctrine.orm.entity_manager');
        $situationLists = $em->getRepository(SituationGroup::class)->findOneById($situationGroupId)->getSituations();
        foreach ($situationLists as $situation) {
            $arrayOfSituationId[] = $situation->getId();
        }

        return in_array($situationId, $arrayOfSituationId);
    }

    private function checkIntegrityRisk($situationId, $riskId) {
        $em =  $this->getConfigurationPool()->getContainer()->get('doctrine.orm.entity_manager');
        $riskLists = $em->getRepository(Situation::class)->findOneById($situationId)->getRisks();
        foreach ($riskLists as $risk) {
            $arrayOfRiskId[] = $risk->getId();
        }
        if (!isset($arrayOfRiskId)) {
            return false;
        }
        return in_array($riskId, $arrayOfRiskId);
    }

    private function checkIntegrityTool($situationId, $toolId) {
        $em =  $this->getConfigurationPool()->getContainer()->get('doctrine.orm.entity_manager');
        $toolLists = $em->getRepository(Situation::class)->findOneById($situationId)->getTools();
        foreach ($toolLists as $tool) {
            $arrayOfToolId[] = $tool->getId();
        }
        if (!isset($arrayOfToolId)) {
            return false;
        }
        return in_array($toolId, $arrayOfToolId);
    }

    protected function configureFormFields(FormMapper $formMapper)
    {

        $formMapper
            ->tab('Configuration du Ppsps')
                ->with('??tat du document')
                    ->add('status', ChoiceType::class, [
                        'label' => false,
                        'choices' => [
                            'Brouillon' => 'Brouillon',
                            'Valid??' => 'Valid??',
                            'Archiv??' => 'Archiv??',
                        ],
                        'required' => true
                    ])
                ->end()                
                ->with('Configuration g??n??rale')
                    ->add('siteName', TextType::class, [
                        'label' => 'Nom du chantier',
                        'required' => false
                    ])
                    ->add('siteNumber', IntegerType::class, [
                        'label' => 'Num??ro du chantier',
                        'required' => false 
                    ])
                    ->add('globalSiteAddress', TextType::class, [
                        'label' => 'Adresse du chantier',
                        'required' => false
                    ])
                    ->add('periodOfExecution', TextType::class, [
                        'label' => 'P??riode d\'ex??cution',
                        'required' => false
                    ])        
                    ->add('owner', TextType::class, [
                        'label' => 'Ma??tre d\'ouvrage',
                        'required' => false
                    ])
                    ->add('editor', TextType::class, [
                        'label' => 'R??dacteur',
                        'required' => false
                    ])
                    ->add('firstWorkConductor', TextType::class, [
                        'label' => 'Conducteur de Travaux',
                        'required' => false
                    ])
                    ->add('projectDirector', TextType::class, [
                        'label' => 'Directeur de projet',
                        'required' => false
                    ])
                    ->add('approbator', TextType::class, [
                        'label' => 'Approbateur',
                        'required' => false
                    ])
                    ->add('projectManager', TextType::class, [
                        'label' => 'Ma??tre d\'oeuvre',
                        'required' => false
                    ])
                    ->add('AddressAccessSite', TextType::class, [
                        'label' => 'Adresse d\'acc??s au chantier',
                        'required' => false
                    ])
                    ->add('referent', TextType::class, [
                        'label' => 'Personne r??f??rente sur site',
                        'required' => false
                    ])
                    ->add('referentPhone', TextType::class, [
                        'label' => 'T??l??phone du r??f??rent',
                        'required' => false
                    ])
                    ->add('referentMail', TextType::class, [
                        'label' => 'Mail du r??f??rent',
                        'required' => false
                    ])
                    ->add('image', ModelType::class, [
                        'label' => 'Plan d\'identification des travaux',
                        'required' => false,
                        'by_reference' => false,
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
                        'label' => 'Configuration du tableau de mise ?? jour',
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
                            'Groupement int??gr?? - Mandataire' => 'mandatory'
                        ],
                        'required' => false
                    ])
                    ->add('mandatoryDescr', TextType::class, [
                        'label' => 'Description groupement int??gr?? - Mandataire',
                        'required' => false
                    ])
                    ->add('descrWork', TextareaType::class, [
                        'label' => 'Description des travaux propres ?? l\'entreprise (ou du Groupement)',
                        'required' => false 
                    ])
                    ->add('subcontractedWorks', CollectionType::class, [
                        'label' => 'Travaux sous-trait??s envisag??s',
                        'required' => false,
                        'by_reference' => false,
                        'type_options' => [
                            'delete' => true,
                        ],
                    ], [
                        'edit' => 'inline',
                        'inline' => 'table',
                    ])
                    ->add('annexSubworkers', CheckboxType::class, [
                        'label'=> 'Liste des sous-traitants en annexe',
                        'required' => false
                    ])
                ->end()
                ->with('Calendrier des travaux')
                    ->add('dateBegin', DatePickerType::class, [
                        'label' => 'Date de d??but pr??vu du chantier',
                        'dp_side_by_side'       => true,
                        'dp_use_current'        => false,
                        'dp_collapse'           => true,
                        'dp_calendar_weeks'     => false,
                        'dp_view_mode'          => 'days',
                        'dp_min_view_mode'      => 'days',
                        'required' => false,
                    ])
                    ->add('dateEnd', DatePickerType::class, [
                        'label' => 'Date de fin pr??vu du chantier',
                        'dp_side_by_side'       => true,
                        'dp_use_current'        => false,
                        'dp_collapse'           => true,
                        'dp_calendar_weeks'     => false,
                        'dp_view_mode'          => 'days',
                        'dp_min_view_mode'      => 'days',
                        'required' => false,
                    ])
                    ->add('openingSite', DatePickerType::class, [
                        'label' => 'D??claration d\'ouverture de chantier',
                        'dp_side_by_side'       => true,
                        'dp_use_current'        => false,
                        'dp_collapse'           => true,
                        'dp_calendar_weeks'     => false,
                        'dp_view_mode'          => 'days',
                        'dp_min_view_mode'      => 'days',
                        'required' => false,
                    ])
                ->end()
                ->with('Arr??t de chantier')
                    ->add('beginStopWork', DatePickerType::class, [
                        'label' => 'Du',
                        'dp_side_by_side'       => true,
                        'dp_use_current'        => false,
                        'dp_collapse'           => true,
                        'dp_calendar_weeks'     => false,
                        'dp_view_mode'          => 'days',
                        'dp_min_view_mode'      => 'days',
                        'required' => false,
                    ])
                    ->add('endStopWork', DatePickerType::class, [
                        'label' => 'Au',
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
                    ->add('optionalDICTMessage', TextType::class, [
                        'label' => 'Renvoyer en annexe',
                        'required' => false
                    ])
                ->end()
                ->with('Organisation de l\'entreprise (ou du groupement)')
                    ->add('AQSE', ModelType::class, [
                        'label' => 'Animateur Qualit?? S??curit?? Environnement',
                        'required' => false,
                        'multiple' => false,
                        'property' => 'name',
                        'btn_add' => false
                    ])
                    ->add('workDirectors', ModelType::class, [
                        'label' => 'Conducteur(s) de Travaux',
                        'required' => false,
                        'multiple' => true,
                        'property' => 'name',
                        'btn_add' => false
                    ])
                    ->add('siteManagers', ModelType::class, [
                        'label' => 'Chef(s) de chantier',
                        'property' => 'name',
                        'required' => false,
                        'multiple' => true,
                        'btn_add' => false
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
                ->with('Horraires sur le chantier')
                    ->add('MondayMorning', TextType::class, [
                        'required' => false,
                        'label' => 'Lundi Matin'
                    ])
                    ->add('MondayAfternoon', TextType::class, [
                        'required' => false,
                        'label' => 'Lundi Apr??s-Midi'
                    ])
                    ->add('tuesdayMorning', TextType::class, [
                        'required' => false,
                        'label' => 'Mardi Matin'
                    ])
                    ->add('tuesdayAfternoon', TextType::class, [
                        'required' => false,
                        'label' => 'Mardi Apr??s-Midi'
                    ])
                    ->add('wednesdayMorning', TextType::class, [
                        'required' => false,
                        'label' => 'Mercredi Matin'
                    ])
                    ->add('wednesdayAfternoon', TextType::class, [
                        'required' => false,
                        'label' => 'Mercredi Apr??s-Midi'
                    ])
                    ->add('thursdayMorning', TextType::class, [
                        'required' => false,
                        'label' => 'Jeudi Matin'
                    ])
                    ->add('thursdayAfternoon', TextType::class, [
                        'required' => false,
                        'label' => 'Jeudi Apr??s-Midi'
                    ])
                    ->add('fridayMorning', TextType::class, [
                        'required' => false,
                        'label' => 'Vendredi Matin'
                    ])
                    ->add('fridayAfternoon', TextType::class, [
                        'required' => false,
                        'label' => 'Vendredi Apr??s-Midi'
                    ])
                ->end()
                ->with('Organismes de pr??vention')
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
                ->with('C.I.S.S.C.T.')
                    ->add('myCissct', CheckboxType::class, [
                        'label'=> 'Obligation',
                        'required' => false
                    ])
                ->end()
                ->with('Coordonation SPS')
                    ->add('securityCoordinator', CheckboxType::class, [
                        'label'=> 'Coordonnateur s??curit??',
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
                        'label' => 'Nom du coordinateur s??curit??',
                        'required' => false
                    ])
                    ->add('PGCRef', TextType::class, [
                        'label' => 'R??ference du PGC',
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
                ->with('Acc??s, circulation et cl??tures ??')
                    ->add('isControlled', CheckboxType::class, [
                        'label'=> 'Acc??s Contr??l??',
                        'required' => false
                    ])
                    ->add('isGuardian', CheckboxType::class, [
                        'label'=> 'Pr??sence d\'un Gardien',
                        'required' => false
                    ])
                ->end()
                ->with('Installations de chantier')
                    ->add('isMaintenedByRougeot', CheckboxType::class, [
                        'label'=> 'Maintenu par rougeot',
                        'required' => false
                    ])
                    ->add('maintainer', TextType::class, [
                        'label' => 'Maintenu et entretenu par l\'entreprise',
                        'required' => false
                    ])
                    ->add('listOfInstallations', ChoiceType::class, [
                        'label' => false,
                        'choices' => [
                            'Installation mobile ??quip??e' => 'Installation mobile ??quip??e',
                            'WC raccord??' => 'WC raccord??',
                            'WC non raccord??' => 'WC non raccord??',
                            'Installation fixe' => 'Installation fixe',
                            'Bureau de chantier' => 'Bureau de chantier',
                            'Vestiaire' => 'Vestiaire',
                            'R??fectoire' => 'R??fectoire',
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
                ->end()
                ->with('Affichage??et documents obligatoires sur le chantier')
                    ->add('listOfWorksMandatoryDocs', ChoiceType::class, [
                        'label' => false,
                        'choices' => [
                            'Le r??glement int??rieur de l???entreprise' => 'Le r??glement int??rieur de l???entreprise',
                            'Les horaires de travail et la p??riode de fermeture de l???entreprise le cas ??ch??ant*' => 'Les horaires de travail et la p??riode de fermeture de l???entreprise le cas ??ch??ant*',
                            'Les coordonn??es de la m??decine du travail*' => 'Les coordonn??es de la m??decine du travail*',
                            'Les coordonn??es de l???inspection du travail*' => 'Les coordonn??es de l???inspection du travail*',
                            'Le lieu o?? est situ??e l???infirmerie, pour les chantiers de plus de 300 personnes' => 'Le lieu o?? est situ??e l???infirmerie, pour les chantiers de plus de 300 personnes',
                            'Les consignes de s??curit?? incendie*' => 'Les consignes de s??curit?? incendie*',
                            'Les num??ros d???urgence et de secours*' => 'Les num??ros d???urgence et de secours*',
                            'L???affiche r??capitulative des consignes de premiers secours' => 'L???affiche r??capitulative des consignes de premiers secours',
                            'La liste des Sauveteurs Secouristes pr??sents sur le chantier' => 'La liste des Sauveteurs Secouristes pr??sents sur le chantier',
                            'L???interdiction de fumer*' => 'L???interdiction de fumer*',
                            'La liste des membres du CSE*' => 'La liste des membres du CSE*',
                        ],
                        'multiple' => true,
                        'expanded' => true,
                        'sonata_help' => 'Attention??! Les documents avec * sont ?? afficher imp??rativement dans les installations de chantier. Mod??les en annexe '
                    ])
                ->end()
                ->with('Autorisation et habilitation particuli??re du personnel')
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
                            'Conduite de nacelles ??l??vatrices ou P.E.M.P.' => 'Conduite de nacelles ??l??vatrices ou P.E.M.P.',
                            'Utilisation d\'explosifs CPT' => 'Utilisation d\'explosifs CPT',
                            'Travail en ??gout CATE 2' => 'Travail en ??gout CATE 2',
                            'Echafaudage: montage/d??montage' => 'Echafaudage: montage/d??montage',
                            'Echafaudage: r??ception' => 'Echafaudage: r??ception',
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
                            'Registre unique de s??curit??' => 'Registre unique de s??curit??',
                            'Registre d\'observations' => 'Registre d\'observations',
                            'Registre du personnel sur chantier' => 'Registre du personnel sur chantier',
                            'Registre des avis de dangers grave et imminent' => 'Registre des avis de dangers grave et imminent',
                            'PV de contr??le installation grue' => 'PV de contr??le installation grue',
                            'PV de contr??le installation ??lectrique' => 'PV de contr??le installation ??lectrique',
                            'Permis de d??molir' => 'Permis de d??molir',
                            'Autorisation de voirie' => 'Autorisation de voirie',
                            'Arr??t?? de circulation' => 'Arr??t?? de circulation',
                        ],
                        'multiple' => true,
                        'expanded' => true,
                    ])
                ->end()
                ->with('Mesures Particuli??res ou risques import??s')
                    ->add('particularSecurityDetail', CheckboxType::class, [
                        'label' => 'Mesures particuli??res au chantier',
                        'required' => false,
                    ])
                    ->add('particularExternalRisk', CheckboxType::class, [
                        'label'=> 'Existe-t-il des risques import??s ou export??s particuliers au chantier non trait??s dans l\'analyse des risques',
                        'required' => false,
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
            'label' => 'Num??ro du chantier'
        ]);
        if (in_array('ROLE_ADMIN', $this->getUser()->getRoles())) {
            $datagridMapper->add('groupment', null, [
                'label' => 'Groupe'
            ]);
        }
        $datagridMapper->add('status', ChoiceFilter::class, [
            'label' => 'Etat du document',
            'choices' => [
                'Brouillon' => 'Brouillon',
                'Valid??' => 'Valid??',
                'Archiv??' => 'Archiv??',
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
            'label' => 'Num??ro du chantier'
        ]);
        $listMapper->add('globalSiteAddress', null, [
            'label' => 'Adresse du chantier'
        ]);        
        $listMapper->add('periodOfExecution', null, [
            'label' => 'P??riode d\'ex??cution'
        ]);
        $listMapper->add('owner', null, [
            'label' => 'Ma??tre d\'ouvrage',
        ]);
        $listMapper->add('projectManager', null, [
            'label' => 'Ma??tre d\'oeuvre',
        ]);
        $listMapper->add('status', ChoiceType::class, [
            'label' => 'Etat du document',
        ]);
        $listMapper->add('_action', null, [
            'actions' => [
                'edit' => ['template' => 'admin/action/customeditaction.html.twig'],
                'delete' => [],
                'preview' => ['template' => 'admin/action/preview.html.twig'],
                'export' => ['template' => 'admin/action/export.html.twig']
            ]
        ]);
    }

    public function createQuery($context = 'list')
    {
        $query = parent::createQuery($context);
        if (!in_array('ROLE_ADMIN', $this->getUser()->getRoles())) {
            $query->where($query->expr()->eq($query->getRootAliases()[0] . '.groupment', ':groupmentId'));
            $query->setParameter('groupmentId', $this->getUser()->getGroupment()->getId());
        }
        return $query;
    }

    private function getUser()
    {
        $tokenStorage = $this->getConfigurationPool()->getContainer()->get('security.token_storage')->getToken();
        return ($tokenStorage) ? $tokenStorage->getUser() : null;
    }
}

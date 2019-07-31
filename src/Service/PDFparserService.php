<?php
/* Copyright (C) Logomotion - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 */

namespace App\Service;

use App\Entity\Ppsps;
use App\Repository\PpspsRepository;
use App\Repository\SituationRepository;
use App\Repository\SituationGroupRepository;
use App\Repository\MeasureRepository;
use App\Repository\ToolRepository;
use App\Repository\RiskRepository;

class PDFparserService
{
    /**
     * @var ContentRepository
     */
    private $ppspsRepository;

    /**
     * @var SituationRepository
     */
    private $situationRepository;

    /**
     * @var SituationRepository
     */
    private $situationGroupRepository;

    /**
     * @var RiskRepository
     */
    private $riskRepository;

    /**
     * @var ToolRepository
     */
    private $toolRepository;
    
    /**
     * @var MeasureRepository
     */
    private $measureRepository;
    
    /**
     * Constructor
     *
     * @param PpspRepository $ppspsRepository
     */
    public function __construct(
        PpspsRepository $ppspsRepository,
        SituationRepository $situationRepository,
        SituationGroupRepository $situationGroupRepository,
        ToolRepository $toolRepository,
        MeasureRepository $measureRepository,
        RiskRepository $riskRepository
    ) {
        $this->ppspsRepository = $ppspsRepository;
        $this->situationRepository = $situationRepository;
        $this->situationGroupRepository = $situationGroupRepository;
        $this->toolRepository = $toolRepository;
        $this->measureRepository = $measureRepository;
        $this->riskRepository = $riskRepository;
    }

    public function getPpspsById($id) {
        $ppsps = $this->ppspsRepository->findByid($id)[0];
        
        if ($ppsps->getGroupment() == null) {
            $logo = null;
        } else if ($ppsps->getGroupment()->getLogo() == null) {
            $logo = null;
        } else {
            $logo = $ppsps->getGroupment()->getLogo()->getImageFile()->getBasename();
        }
        
        if ($ppsps->getImage() == null) {
            $image = null;
        } else {
            $image = $ppsps->getImage()->getImageFile()->getBasename();
        }

        return [
            'AddressConstrSite' => $ppsps->getAddressConstrSite(),
            'AddressAccessSite' => $ppsps->getAddressAccessSite(),
            'referent' => $ppsps->getReferent(),
            'editor' => $ppsps->getEditor(),
            'firstWorkConductor' => $ppsps->getFirstWorkConductor(),
            'projectDirector' => $ppsps->getProjectDirector(),
            'approbator' => $ppsps->getApprobator(),
            'referentPhone' => $ppsps->getReferentPhone(),
            'referentMail' => $ppsps->getReferentMail(),
            'siteType' => $ppsps->getSiteType(),
            'descrWork' => $ppsps->getDescrWork(),
            'subWorkDescr' => $ppsps->getSubWorkDescr(),
            'mandatoryDescr' => $ppsps->getMandatoryDescr(),
            'dateBegin' => $this->dateParser($ppsps->getDateBegin()),
            'dateEnd' => $this->dateParser($ppsps->getDateEnd()),
            'openingSite' => $this->dateParser($ppsps->getOpeningSite()),
            'siteName' => $ppsps->getSiteName(),
            'siteNumber' => $ppsps->getSiteNumber(),
            'globalSiteAddress' => $ppsps->getGlobalSiteAddress(),
            'owner' => $ppsps->getOwner(),
            'projectManager' => $ppsps->getProjectManager(),
            'periodOfExecution' => $ppsps->getPeriodOfExecution(),
            'effectives' => $this->effectiveParser($ppsps->getEffectives()->getValues()),
            'securityCoordinator' => $ppsps->getSecurityCoordinator(),
            'PGC' => $ppsps->getPGC(),
            'PGCRef' => $ppsps->getPGCRef(),
            'PGCDate' => $this->dateParser($ppsps->getPGCDate()),
            'inspectionVisitDate' => $this->dateParser($ppsps->getInspectionVisitDate()),
            'listOfInstallations' => $ppsps->getListOfInstallations(),
            'listOfWorksMandatoryDocs' => $ppsps->getListOfWorksMandatoryDocs(),
            'suiabilityList' => $ppsps->getSuiabilityList(),
            'suiability' => $ppsps->getSuiability(),
            'otherInstalation' => $ppsps->getOtherInstalation(),
            'particularExternalRisk' => $ppsps->getParticularExternalRisk(),
            'particularSecurityMeasure' => $ppsps->getParticularSecurityMeasure(),
            'particularSecurityDetail' => $ppsps->getParticularSecurityDetail(),
            'situations' => $this->situationParser($ppsps->getSituation()),
            'diffusions' => $this->diffusionParser($ppsps->getDiffusions()->getValues()),
            'speakers' => $this->speakerParser($ppsps->getSpeakers()->getValues()),
            'myCissct' => $ppsps->getMyCissct(),
            'annexSubworkers' => $ppsps->getAnnexSubworkers(),
            'updatesPpsps' => $this->updateParser($ppsps->getUpdatesPpsps()->getValues()),
            'dealers' => $this->dealerParser($ppsps->getDealers()->getValues()),
            'securityCoordinatorName' => $ppsps->getSecurityCoordinatorName(),
            'AQSE' => $ppsps->getAQSE(),
            'maintainer' => $ppsps->getMaintainer(),
            'status' => $ppsps->getStatus(),
            'siteLevel' => $ppsps->getSiteLevel(),
            'subContractedWorks' => $this->subContractedWorkParser($ppsps->getSubContractedWorks()->getValues()),
            'workDirectors' => $this->personParser($ppsps->getWorkDirectors()->getValues()),
            'siteManagers' => $this->personParser($ppsps->getSiteManagers()->getValues()),
            'beginStopWork' => $this->dateParser($ppsps->getBeginStopWork()),
            'endStopWork' => $this->dateParser($ppsps->getEndStopWork()),
            'optionalDICTMessage' => $ppsps->getOptionalDICTMessage(),
            'isMaintenedByRougeot' => $ppsps->getIsMaintenedByRougeot(),
            'isGuardian' => $ppsps->getIsGuardian(),
            'isControlled' => $ppsps->getIsControlled(),
            'annexs' => $ppsps->getAnnexs()->getValues(),
            'mandatoryDocument' => $ppsps->getMandatoryDocument(),
            'logo' => $logo,
            'image' => $image
        ];
    }

    private function diffusionParser($diffusionsList) {
        if ($diffusionsList === []) {
            return null;
        }

        $page = 0;
        foreach ($diffusionsList as $key => $diffusion) {
            if ($key % 25 === 0) {
                $page++;
            }
            $diffusions[$page][$key]['recipient'] = $diffusion->getRecipient();
            $diffusions[$page][$key]['name'] = $diffusion->getName();
            $diffusions[$page][$key]['date'] = $this->dateParser($diffusion->getDate());
            $diffusions[$page][$key]['paper'] = $diffusion->getPaper();
            $diffusions[$page][$key]['isNumeric'] = $diffusion->getIsNumeric();
            $diffusions[$page][$key]['email'] = $diffusion->getEmail();
        }
        return $diffusions;
    }

    private function updateParser($updatesList) {
        if ($updatesList === []) {
            return null;
        }
        $page = 0;
        foreach ($updatesList as $key => $update) {
            if ($key % 25 === 0) {
                $page++;
            }
            $updates[$page][$key]['updateObject'] = $update->getUpdateObject();
            $updates[$page][$key]['indexUpdate'] = $update->getIndexUpdate();
            $updates[$page][$key]['updateDate'] = $this->dateParser($update->getUpdateDate());
            $updates[$page][$key]['writeBy'] = $update->getWriteBy();
            $updates[$page][$key]['aprovedBy'] = $update->getAprovedBy();
        }
        return $updates;
    }

    private function speakerParser($speakersList) {
        if ($speakersList === []) {
            return null;
        }
        $page = 0;
        foreach ($speakersList as $key => $speaker) {
            if ($key % 15 === 0) {
                $page++;
            }
            $speakers[$page][$key]['name'] = $speaker->getName();
            $speakers[$page][$key]['contact'] = $speaker->getContact();
            $speakers[$page][$key]['address'] = $speaker->getAddress();
            $speakers[$page][$key]['fax'] = $speaker->getFax();
            $speakers[$page][$key]['Mail'] = $speaker->getMail();
        }
        return $speakers;
    }
    
    private function effectiveParser($effectivesList) {
        if ($effectivesList === []) {
            return null;
        }
        $page = 0;
        foreach ($effectivesList as $key => $effective) {
            if ($key % 25 === 0) {
                $page++;
            }
            $effectives[$page][$key]['business'] = $effective->getBusiness();
            $effectives[$page][$key]['average'] = $effective->getAverage();
            $effectives[$page][$key]['maximum'] = $effective->getMaximum();
        }
        return $effectives;
    }

    private function dealerParser($dealersList) {
        if ($dealersList === []) {
            return null;
        }
        $page = 0;
        foreach ($dealersList as $key => $dealer) {
            if ($key % 25 === 0) {
                $page++;
            }
            $dealers[$page][$key]['name'] = $dealer->getName();
            $dealers[$page][$key]['mail'] = $dealer->getMail();
            $dealers[$page][$key]['sendingDate'] = $this->dateParser($dealer->getSendingDate());
        }
        return $dealers;
    }

    private function subContractedWorkParser($subContractedWorksList) {
        if ($subContractedWorksList === []) {
            return null;
        }
        $page = 0;
        foreach ($subContractedWorksList as $key => $subContractedWork) {
            if ($key % 25 === 0) {
                $page++;
            }
            $subContractedWorks[$page][$key]['subContractor'] = $subContractedWork->getSubContractor();
            $subContractedWorks[$page][$key]['address'] = $subContractedWork->getAddress();
            $subContractedWorks[$page][$key]['subcontractedActivity'] = $subContractedWork->getSubcontractedActivity();
        }
        return $subContractedWorks;
    }

    private function personParser($personsList) {
        if ($personsList === []) {
            return null;
        }
        foreach ($personsList as $key => $person) {
            $persons[$key]['name'] = $person->getName();
            $persons[$key]['company'] = $person->getCompany();
            $persons[$key]['address'] = $person->getAddress();
            $persons[$key]['fax'] = $person->getFax();
            $persons[$key]['email'] = $person->getEmail();
            $persons[$key]['phoneNumber'] = $person->getPhoneNumber();
        }
        return $persons;
    }
    
    private function situationParser($situationsList) {
        if ($situationsList == []) {
            return null;
        }
        $situationGroupList = [];
        foreach ($situationsList as $key => $situation) {
            if (!in_array($situation['situationGroup'],$situationGroupList)) {
                $situationGroupList[] = $situation['situationGroup'];
            }
        }
        foreach ($situationGroupList as $key => $situationGroup){
            $situations[$situationGroup]['situationGroup'] = $this->situationGroupRepository->findById($situationGroup)[0]->getName();
            foreach ($situationsList as $key => $situation) {
                if(isset($situation['situation'])) {
                    if ($situationGroup = $situation['situationGroup']) {
                        $situations[$situationGroup][$key]['situation'] = $this->situationRepository->findById($situation['situation'])[0]->getName();
                        if (isset($situation['risk'])) {
                            foreach ($situation['risk'] as $riskKey => $risk) {
                                $situations[$situationGroup][$key]['risk'][$riskKey] = $this->riskRepository->findById($risk)[0]->getName();
                            }
                        }
                        if (isset($situation['tool'])) {
                            foreach ($situation['tool'] as $toolKey => $tool) {
                                $situations[$situationGroup][$key]['tool'][$toolKey] = $this->toolRepository->findById($tool)[0]->getName();
                            }
                        }
                        if (isset($situation['measure'])) {
                            foreach ($situation['measure'] as $measureKey => $measure) {
                                $situations[$situationGroup][$key]['measure'][$measureKey] = $this->measureRepository->findById($measure)[0]->getDescr();
                            }
                        }
                    }
                }
            }
        }
        $situations = $this->parseSituation($situations);
        return $situations;
    }

    private function parseSituation($situations) {
        foreach ($situations as $key => $situation){
            if(count($situation) > 3) {
                $chunk = array_chunk($situation, 3, 3);
                $situations[$key] = $chunk;
            } else {
                unset($situations[$key]);
                $situations[$key][0] = $situation;
            }
            if (isset($situation['situationGroup'])) {
                $situations[$key]['situationGroup'] = $situation['situationGroup'];
            }
        }
        foreach ($situations as $fisrtKey => $situation){
            foreach ($situation as $secondKey => $oneGroupedSituation) {
                if(is_array($oneGroupedSituation)) {
                    foreach ($oneGroupedSituation as $thirdkey => $oneSituation){
                        if(!is_array($oneSituation)){
                            unset($situations[$fisrtKey][$secondKey][$thirdkey]);
                        }
                    }
                }
            }
        }
        return $situations;
    }

    private function dateParser($date) {
        if ($date === null) {
            return null;
        }
        return $date->format('d/m/Y');
    }
}

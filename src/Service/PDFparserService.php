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
            'suiabilityList' => $ppsps->getSuiabilityList(),
            'suiability' => $ppsps->getSuiability(),
            'otherInstalation' => $ppsps->getOtherInstalation(),
            'particularSecurityMeasure' => $ppsps->getParticularSecurityMeasure(),
            'particularSecurityDetail' => $ppsps->getParticularSecurityDetail(),
            'situations' => $this->situationParser($ppsps->getSituation()),
            'diffusions' => $this->diffusionParser($ppsps->getDiffusions()->getValues()),
            'speakers' => $this->speakerParser($ppsps->getSpeakers()->getValues()),
            'chiefWorkRepresentative' => $ppsps->getChiefWorkRepresentative(),
            'myCissct' => $ppsps->getMyCissct(),
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
        foreach ($diffusionsList as $key => $diffusion) {
            $diffusions[$key]['recipient'] = $diffusion->getRecipient();
            $diffusions[$key]['name'] = $diffusion->getName();
            $diffusions[$key]['date'] = $this->dateParser($diffusion->getDate());
            $diffusions[$key]['paper'] = $diffusion->getPaper();
            $diffusions[$key]['isNumeric'] = $diffusion->getIsNumeric();
            $diffusions[$key]['email'] = $diffusion->getEmail();
        }
        return $diffusions;
    }

    private function updateParser($updatesList) {
        if ($updatesList === []) {
            return null;
        }
        foreach ($updatesList as $key => $update) {
            $updates[$key]['updateObject'] = $update->getUpdateObject();
            $updates[$key]['indexUpdate'] = $update->getIndexUpdate();
            $updates[$key]['updateDate'] = $this->dateParser($update->getUpdateDate());
            $updates[$key]['writeBy'] = $update->getWriteBy();
            $updates[$key]['aprovedBy'] = $update->getAprovedBy();
        }
        return $updates;
    }

    private function speakerParser($speakersList) {
        if ($speakersList === []) {
            return null;
        }
        foreach ($speakersList as $key => $speaker) {
            $speakers[$key]['name'] = $speaker->getName();
            $speakers[$key]['contact'] = $speaker->getContact();
            $speakers[$key]['address'] = $speaker->getAddress();
            $speakers[$key]['fax'] = $speaker->getFax();
            $speakers[$key]['Mail'] = $speaker->getMail();
        }
        return $speakers;
    }
    
    private function effectiveParser($effectivesList) {
        if ($effectivesList === []) {
            return null;
        }
        foreach ($effectivesList as $key => $effective) {
            $effectives[$key]['business'] = $effective->getBusiness();
            $effectives[$key]['average'] = $effective->getAverage();
            $effectives[$key]['maximum'] = $effective->getMaximum();
        }
        return $effectives;
    }

    private function dealerParser($dealersList) {
        if ($dealersList === []) {
            return null;
        }
        foreach ($dealersList as $key => $dealer) {
            $dealers[$key]['name'] = $dealer->getName();
            $dealers[$key]['mail'] = $dealer->getMail();
            $dealers[$key]['sendingDate'] = $this->dateParser($dealer->getSendingDate());
        }
        return $dealers;
    }

    private function subContractedWorkParser($subContractedWorksList) {
        if ($subContractedWorksList === []) {
            return null;
        }
        foreach ($subContractedWorksList as $key => $subContractedWork) {
            $subContractedWorks[$key]['subContractor'] = $subContractedWork->getSubContractor();
            $subContractedWorks[$key]['address'] = $subContractedWork->getAddress();
            $subContractedWorks[$key]['subcontractedActivity'] = $subContractedWork->getSubcontractedActivity();
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
                $situationGroupList[] =$situation['situationGroup'];
            }
        }
        foreach ($situationGroupList as $situationGroup){
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
                                $situations[$situationGroup][$key]['measure'][$measureKey] = $this->measureRepository->findById($measure)[0]->getName();
                            }
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

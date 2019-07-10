<?php
/* Copyright (C) Logomotion - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 */

namespace App\Service;

use App\Entity\Ppsps;
use App\Repository\PpspsRepository;
use App\Repository\SituationRepository;
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
        ToolRepository $toolRepository,
        MeasureRepository $measureRepository,
        RiskRepository $riskRepository
    ) {
        $this->ppspsRepository = $ppspsRepository;
        $this->situationRepository = $situationRepository;
        $this->toolRepository = $toolRepository;
        $this->measureRepository = $measureRepository;
        $this->riskRepository = $riskRepository;
    }

    public function getPpspsById($id) {
        $ppsps = $this->ppspsRepository->findByid($id)[0];
        $situations = $ppsps->getSituation();
        foreach ($situations as $key => $situation) {
            $situations[$key]['situation'] = $this->situationRepository->findById($situation['situation'])[0]->getName();
            
            if (isset($situation['risk'])) {
                foreach ($situation['risk'] as $riskKey => $risk) {
                    $situations[$key]['risk'][$riskKey] = $this->riskRepository->findById($risk)[0]->getName();
                }
            }
            if (isset($situation['tool'])) {
                foreach ($situation['tool'] as $toolKey => $tool) {
                    $situations[$key]['tool'][$toolKey] = $this->toolRepository->findById($tool)[0]->getName();
                }
            }
            if (isset($situation['measure'])) {
                foreach ($situation['measure'] as $measureKey => $measure) {
                    $situations[$key]['measure'][$measureKey] = $this->measureRepository->findById($measure)[0]->getName();
                }
            }
        }
        $ppsps->setSituation($situations);
        return $ppsps;
    }
}

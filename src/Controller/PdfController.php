<?php
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Service\PDFparserService;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
use Symfony\Component\HttpFoundation\Response;

class PdfController extends Controller
{

    /**
     * @var PDFparserService
     */
    private $PDFparserService;
    
    /**
     * Constructor
     *
     * @param PDFparserService $PDFparserService
     */
    public function __construct(
        PDFparserService $PDFparserService
    ) {
        $this->PDFparserService = $PDFparserService;
    }

     /**
     * @Route("/preview/{id}", name="pdf", methods={"GET"})
     */
    public function previewPDF($id)
    {   
        $ppsps = $this->PDFparserService->getPpspsById($id);
        $html = $this->generateHtml($ppsps);
        return new Response($html);
    }

    /**
     * @Route("/generate/{id}", name="generatePDF", methods={"GET"})
     */
    public function generatePDF($id)
    {
        $ppsps = $this->PDFparserService->getPpspsById($id);
        $html = $this->generateHtml($ppsps);
        return new PdfResponse(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
            iconv("UTF-8", "ASCII//TRANSLIT", 'PPSPS'.'_'.$ppsps['siteName'].'_'.$ppsps['siteNumber'].'.pdf')
        );
    }

    private function generateHtml($ppsps) {
        $page = 1;
        $html = $this->renderView('ppsps.html.twig',[
            'siteName' => $ppsps['siteName'],
            'siteNumber' => $ppsps['siteNumber'],
            'globalSiteAddress' => $ppsps['globalSiteAddress'],
            'periodOfExecution' => $ppsps['periodOfExecution'],
            'owner' => $ppsps['owner'],
            'logo' => $ppsps['logo'],
            'updatesPpsps' => $ppsps['updatesPpsps'],
            'page' => $page
        ]);

        $html .= $this->renderView('diffusionPPSPS.html.twig',[
            'diffusions' => $ppsps['diffusions'],
            'logo' => $ppsps['logo'],
            'page' => $page
        ]);
        $pageAfter = $page + count($ppsps['diffusions']);
            
        $html .= $this->renderView('updatePPSPS.html.twig',[
            'updatesPpsps' => $ppsps['updatesPpsps'],
            'logo' => $ppsps['logo'],
            'page' => $pageAfter
        ]);
        $pageAfter = $pageAfter + count($ppsps['updatesPpsps']);         
        
        $summaryWorks = $pageAfter + 4;
        $summaryPersons =  $summaryWorks + count($ppsps['subContractedWorks']) + count($ppsps['dealers']) + 1;
        $summaryEffectives = $summaryPersons + count($ppsps['speakers']) + 1;
        $summaryCoordinator = $summaryEffectives + count($ppsps['effectives']);
        $summaryMedicalAndParticular = $summaryCoordinator + 1;
        $summaryReliefOrganization = $summaryMedicalAndParticular + 2;
        $summaryMandatoryDocument = $summaryReliefOrganization + 1;
        $summarySpecificSecurity = $summaryMandatoryDocument + 1;
        $summaryRisks = $summarySpecificSecurity + 1;

        $html .= $this->renderView('summaryPPSPS.html.twig',[
            'logo' => $ppsps['logo'],
            'summaryWorks' => $summaryWorks,
            'summaryPersons' => $summaryPersons,
            'summaryEffectives' => $summaryEffectives,
            'summaryCoordinator' => $summaryCoordinator,
            'summaryMedicalAndParticular' => $summaryMedicalAndParticular,
            'summaryReliefOrganization' => $summaryReliefOrganization,
            'summaryMandatoryDocument' => $summaryMandatoryDocument,
            'summarySpecificSecurity' => $summarySpecificSecurity,
            'summaryRisks' => $summaryRisks,
            'page' => $pageAfter
        ]);
        $pageAfter = $pageAfter + 3;   

        $html .= $this->renderView('workPPSPS.html.twig',[
            'logo' => $ppsps['logo'],
            'AddressConstrSite' => $ppsps['AddressConstrSite'],
            'AddressAccessSite' => $ppsps['AddressAccessSite'],
            'referent' => $ppsps['referent'],
            'referentPhone' => $ppsps['referentPhone'],
            'referentMail' => $ppsps['referentMail'],
            'siteType' => $ppsps['siteType'],
            'descrWork' => $ppsps['descrWork'],
            'mandatoryDescr' => $ppsps['mandatoryDescr'],
            'dateBegin' => $ppsps['dateBegin'],
            'dateEnd' => $ppsps['dateEnd'],
            'beginStopWork' => $ppsps['beginStopWork'],
            'endStopWork' => $ppsps['endStopWork'],
            'openingSite' => $ppsps['openingSite'],
            'page' => $pageAfter
        ]);
        $pageAfter = $pageAfter + 1;

        $html .= $this->renderView('subcontractedWorksPPSPS.html.twig',[
            'logo' => $ppsps['logo'],
            'subContractedWorks' => $ppsps['subContractedWorks'],
            'page' => $pageAfter
        ]);
        $pageAfter = $pageAfter + count($ppsps['subContractedWorks']);
        
        $html .= $this->renderView('dealersPPSPS.html.twig',[
            'logo' => $ppsps['logo'],
            'dealers' => $ppsps['dealers'],
            'page' => $pageAfter
        ]);
        $pageAfter = $pageAfter + count($ppsps['dealers']);

        $html .= $this->renderView('persons.html.twig',[
            'logo' => $ppsps['logo'],
            'AQSE' => $ppsps['AQSE'],
            'workDirectors' => $ppsps['workDirectors'],
            'siteManagers' => $ppsps['siteManagers'],
            'page' => $pageAfter
        ]);
        $pageAfter = $pageAfter + 1;

        $html .= $this->renderView('speakers.html.twig',[
            'logo' => $ppsps['logo'],
            'speakers' => $ppsps['speakers'],
            'myCissct' => $ppsps['myCissct'],
            'chiefWorkRepresentative' => $ppsps['chiefWorkRepresentative'],
            'page' => $pageAfter
        ]);
        $pageAfter = $pageAfter + count($ppsps['speakers']);

        $html .= $this->renderView('effectives.html.twig',[
            'logo' => $ppsps['logo'],
            'effectives' => $ppsps['effectives'],
            'page' => $pageAfter
        ]);
        $pageAfter = $pageAfter + count($ppsps['effectives']);

        $html .= $this->renderView('bottomPPSPS.html.twig',[
            'logo' => $ppsps['logo'],
            'securityCoordinator' => $ppsps['securityCoordinator'],
            'securityCoordinatorName' => $ppsps['securityCoordinatorName'],
            'PGC' => $ppsps['PGC'],
            'PGCDate' => $ppsps['PGCDate'],
            'PGCRef' => $ppsps['PGCRef'],
            'inspectionVisitDate' => $ppsps['inspectionVisitDate'],
            'siteLevel' => $ppsps['siteLevel'],
            'isControlled' => $ppsps['isControlled'],
            'isGuardian' => $ppsps['isGuardian'],
            'listOfInstallations' => $ppsps['listOfInstallations'],
            'isMaintenedByRougeot' => $ppsps['isMaintenedByRougeot'],
            'maintainer' => $ppsps['maintainer'],
            'suiabilityList' => $ppsps['suiabilityList'],
            'mandatoryDocument' => $ppsps['mandatoryDocument'],
            'particularSecurityMeasure' => $ppsps['particularSecurityMeasure'],
            'particularSecurityDetail' => $ppsps['particularSecurityDetail'],
            'page' => $pageAfter
        ]);
        $pageAfter = $pageAfter + 6;

        $html .= $this->renderView('situationPPSPS.html.twig',[
            'logo' => $ppsps['logo'],
            'situations' => $ppsps['situations'],
            'page' => $pageAfter
        ]);
        $pageAfter = $pageAfter + 6;

        return $html;
    }
}
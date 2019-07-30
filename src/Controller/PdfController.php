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
        $annexs = $ppsps['annexs'];
        foreach ($annexs as $annex) {
           $this->generateAnnex($annex);
        }
        $html = $this->generateHtml($ppsps);
        return new PdfResponse(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
            iconv("UTF-8", "ASCII//TRANSLIT", 'PPSPS'.'_'.$ppsps['siteName'].'_'.$ppsps['siteNumber'].'.pdf')
        );
    }

    private function generateAnnex($annex) {
        return $this->file($annex->getFile(), $annex->getAnnexName().'.pdf');
    }

    private function generateHtml($ppsps) {

        $page = 1;
        $html = $this->renderView('ppsps.html.twig',[
            'siteName' => $ppsps['siteName'],
            'siteNumber' => $ppsps['siteNumber'],
            'editor' => $ppsps['editor'],
            'firstWorkConductor' => $ppsps['firstWorkConductor'],
            'projectDirector' => $ppsps['projectDirector'],
            'approbator' => $ppsps['approbator'],
            'globalSiteAddress' => $ppsps['globalSiteAddress'],
            'periodOfExecution' => $ppsps['periodOfExecution'],
            'owner' => $ppsps['owner'],
            'logo' => $ppsps['logo'],
            'updatesPpsps' => $ppsps['updatesPpsps'],
            'page' => $page
        ]);
        
        if ($ppsps['diffusions'] !== null) {
            $html .= $this->renderView('diffusionPPSPS.html.twig',[
                'siteName' => $ppsps['siteName'],
                'siteNumber' => $ppsps['siteNumber'],
                'diffusions' => $ppsps['diffusions'],
                'logo' => $ppsps['logo'],
                'page' => $page
            ]);
            $pageAfter = $page + count($ppsps['diffusions']);
        } else {
            $pageAfter = $page;
        }
        if ($ppsps['diffusions'] !== null) {
            $html .= $this->renderView('updatePPSPS.html.twig',[
                'siteName' => $ppsps['siteName'],
                'siteNumber' => $ppsps['siteNumber'],
                'updatesPpsps' => $ppsps['updatesPpsps'],
                'logo' => $ppsps['logo'],
                'page' => $pageAfter
            ]);
            $pageAfter = $pageAfter + count($ppsps['updatesPpsps']);         
        } else {
            $pageAfter = $page;
        }
        $summaryWorks = $pageAfter + 4;
        
        if($ppsps['subContractedWorks'] !== null && $ppsps['dealers'] !== null) {
            $summaryPersons =  $summaryWorks + count($ppsps['subContractedWorks']) + count($ppsps['dealers']) + 1;
        } else {
            $summaryPersons = $summaryWorks + 1;
        }
        if ($ppsps['speakers'] !== null ) {
            $summaryEffectives = $summaryPersons + count($ppsps['speakers']) + 1;
        } else {
            $summaryEffectives = $summaryPersons + 1;
        }
        if ($ppsps['effectives'] !== null ) {
            $summaryCoordinator = $summaryEffectives + count($ppsps['effectives']);
        } else {
            $summaryCoordinator = $summaryEffectives;
        }
        $summaryMedicalAndParticular = $summaryCoordinator + 1;
        $summaryReliefOrganization = $summaryMedicalAndParticular + 2;
        $summaryMandatoryDocument = $summaryReliefOrganization + 1;
        $summarySpecificSecurity = $summaryMandatoryDocument + 1;
        $summaryRisks = $summarySpecificSecurity + 1;

        $html .= $this->renderView('summaryPPSPS.html.twig',[
            'siteName' => $ppsps['siteName'],
            'siteNumber' => $ppsps['siteNumber'],
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
        $pageAfter = $pageAfter + 1;   

        $html .= $this->renderView('workPPSPS.html.twig',[
            'siteName' => $ppsps['siteName'],
            'siteNumber' => $ppsps['siteNumber'],
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
        
        $html .= $this->renderView('identWorkPPSPS.html.twig',[
            'logo' => $ppsps['logo'],
            'image' => $ppsps['image'],
            'siteName' => $ppsps['siteName'],
            'siteNumber' => $ppsps['siteNumber'],
            'page' => $pageAfter,
        ]);
        $pageAfter = $pageAfter + 1;

        if ($ppsps['subContractedWorks'] !== null) {
            $html .= $this->renderView('subcontractedWorksPPSPS.html.twig',[
                'siteName' => $ppsps['siteName'],
                'siteNumber' => $ppsps['siteNumber'],
                'logo' => $ppsps['logo'],
                'subContractedWorks' => $ppsps['subContractedWorks'],
                'page' => $pageAfter
            ]);
            $pageAfter = $pageAfter + count($ppsps['subContractedWorks']);
        }
        
        if ($ppsps['dealers'] !== null) {
            $html .= $this->renderView('dealersPPSPS.html.twig',[
                'siteName' => $ppsps['siteName'],
                'siteNumber' => $ppsps['siteNumber'],
                'logo' => $ppsps['logo'],
                'dealers' => $ppsps['dealers'],
                'page' => $pageAfter
            ]);
            $pageAfter = $pageAfter + count($ppsps['dealers']);
        }

        if ($ppsps['siteManagers'] !== null) {
            $html .= $this->renderView('persons.html.twig',[
                'siteName' => $ppsps['siteName'],
                'siteNumber' => $ppsps['siteNumber'],
                'logo' => $ppsps['logo'],
                'AQSE' => $ppsps['AQSE'],
                'workDirectors' => $ppsps['workDirectors'],
                'siteManagers' => $ppsps['siteManagers'],
                'page' => $pageAfter
            ]);
            $pageAfter = $pageAfter + 1;
        }

        if ($ppsps['speakers'] !== null) {
            $html .= $this->renderView('speakers.html.twig',[
                'siteName' => $ppsps['siteName'],
                'siteNumber' => $ppsps['siteNumber'],
                'logo' => $ppsps['logo'],
                'speakers' => $ppsps['speakers'],
                'myCissct' => $ppsps['myCissct'],
                'chiefWorkRepresentative' => $ppsps['chiefWorkRepresentative'],
                'page' => $pageAfter
            ]);
            $pageAfter = $pageAfter + count($ppsps['speakers']);
        }
        
        if ($ppsps['effectives'] !== null) {
            $html .= $this->renderView('effectives.html.twig',[
                'siteName' => $ppsps['siteName'],
                'siteNumber' => $ppsps['siteNumber'],
                'logo' => $ppsps['logo'],
                'effectives' => $ppsps['effectives'],
                'beginStopWork' => $ppsps['beginStopWork'],
                'endStopWork' => $ppsps['endStopWork'],
                'page' => $pageAfter
            ]);
            $pageAfter = $pageAfter + count($ppsps['effectives']);
        }

        $html .= $this->renderView('bottomPPSPS.html.twig',[
            'siteName' => $ppsps['siteName'],
            'siteNumber' => $ppsps['siteNumber'],
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
            'listOfWorksMandatoryDocs' => $ppsps['listOfWorksMandatoryDocs'],
            'isMaintenedByRougeot' => $ppsps['isMaintenedByRougeot'],
            'maintainer' => $ppsps['maintainer'],
            'suiabilityList' => $ppsps['suiabilityList'],
            'mandatoryDocument' => $ppsps['mandatoryDocument'],
            'particularSecurityMeasure' => $ppsps['particularSecurityMeasure'],
            'particularSecurityDetail' => $ppsps['particularSecurityDetail'],
            'particularExternalRisk' => $ppsps['particularExternalRisk'],
            'page' => $pageAfter
        ]);
        $pageAfter = $pageAfter + 6;

        if ($ppsps['situations'] !== null) {
            $html .= $this->renderView('situationPPSPS.html.twig',[
                'siteName' => $ppsps['siteName'],
                'siteNumber' => $ppsps['siteNumber'],
                'logo' => $ppsps['logo'],
                'situations' => $ppsps['situations'],
                'page' => $pageAfter
            ]);
            $pageAfter = $pageAfter + 6;
        }
        return $html;
    }
}
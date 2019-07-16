<?php
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Service\PDFparserService;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;

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
    public function index($id)
    {
        $ppsps = $this->PDFparserService->getPpspsById($id);
        return $this->render(
            'pdf_layout.html.twig',[
                'ppsps' => $ppsps,
            ]
        );
    }

    /**
     * @Route("/generate/{id}", name="generatePDF", methods={"GET"})
     */
    public function generatePDF($id)
    {
        $ppsps = $this->PDFparserService->getPpspsById($id);
        $html = $this->renderView('pdf_layout.html.twig',[
            'ppsps' => $ppsps,
        ]);
        $dayDate = new \DateTime();
        return new PdfResponse(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
            iconv("UTF-8", "ASCII//TRANSLIT", 'PPSPS'.'_'.$ppsps['siteName'].'_'.$ppsps['siteNumber'].'.pdf')
        );
    }
}
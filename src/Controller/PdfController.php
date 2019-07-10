<?php
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Service\PDFparserService;

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
     * @Route("/", name="pdf", methods={"GET"})
     */
    public function index()
    {
     return $this->render(
         'pdf_layout.html.twig'
     );
    }

    /**
     * @Route("/generate/{id}", name="generatePDF", methods={"GET"})
     */
    public function generatePDF($id)
    {
        $ppsps = $this->PDFparserService->getPpspsById($id);
        return $this->render(
            'pdf_layout.html.twig',[
                'ppsps' => $ppsps,
            ]
        );
    }
}
<?php
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
// src/Controller/PdfController.php

class PdfController extends Controller
{
     /**
     * @Route("/", name="pdf", methods={"GET"})
     */
    public function index()
    {
      return $this->render(
         'pdf_layout.html.twig'
     );
    }
}

?>
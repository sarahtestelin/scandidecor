<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\MeubleRepository;
use App\Repository\CategorieRepository;

class CommodeController extends AbstractController
{
    #[Route('/commode', name: 'app_commode')]
    public function commode(MeubleRepository $meubleRepository): Response
    {
        $meubles = $meubleRepository->findAll();
        return $this->render('commode/commode.html.twig', [
            'meubles'=>$meubles
        ]);
    }
}

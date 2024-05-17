<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\MeubleRepository;
use App\Repository\CategorieRepository;

class LuminaireController extends AbstractController
{
    #[Route('/luminaire', name: 'app_luminaire')]
    public function luminaire(MeubleRepository $meubleRepository): Response
    {
        $meubles = $meubleRepository->findAll();
        return $this->render('luminaire/luminaire.html.twig', [
            'meubles'=>$meubles
        ]);
    }
}

<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\MeubleRepository;
use App\Repository\CategorieRepository;

class PlanteController extends AbstractController
{
    #[Route('/plante', name: 'app_plante')]
    public function plante(MeubleRepository $meubleRepository): Response
    {
        $meubles = $meubleRepository->findAll();
        return $this->render('plante/plante.html.twig', [
            'meubles'=>$meubles
        ]);
    }
}

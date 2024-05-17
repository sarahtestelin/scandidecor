<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\MeubleRepository;
use App\Repository\CategorieRepository;

class MeubleTeleController extends AbstractController
{
    #[Route('/meubletele', name: 'app_meubletele')]
    public function meubletele(MeubleRepository $meubleRepository): Response
    {
        $meubles = $meubleRepository->findAll();
        return $this->render('meuble_tele/meubletele.html.twig', [
            'meubles'=>$meubles
        ]);
    }
}

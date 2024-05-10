<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\MeubleRepository;
use App\Repository\CategorieRepository;

class LitController extends AbstractController
{
    #[Route('/lit', name: 'app_lit')]
    public function lit(MeubleRepository $meubleRepository): Response
    {
        $meubles = $meubleRepository->findAll();
        return $this->render('lit/lit.html.twig', [
            'meubles'=>$meubles
        ]);
    }
}

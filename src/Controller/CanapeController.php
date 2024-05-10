<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\MeubleRepository;
use App\Repository\CategorieRepository;

class CanapeController extends AbstractController
{
    #[Route('/canape', name: 'app_canape')]
    public function canape(MeubleRepository $meubleRepository): Response
    {
        $meubles = $meubleRepository->findAll();
        return $this->render('canape/canape.html.twig', [
            'meubles'=>$meubles
        ]);
    }
}

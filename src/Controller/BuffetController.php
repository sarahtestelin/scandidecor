<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\MeubleRepository;
use App\Repository\CategorieRepository;

class BuffetController extends AbstractController
{
    #[Route('/buffet', name: 'app_buffet')]
    public function buffet(MeubleRepository $meubleRepository): Response
    {
        $meubles = $meubleRepository->findAll();
        return $this->render('buffet/buffet.html.twig', [
            'meubles'=>$meubles
        ]);
    }
}

<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\MeubleRepository;
use App\Repository\CategorieRepository;

class ChaiseController extends AbstractController
{
    #[Route('/chaise', name: 'app_chaise')]
    public function chaise(MeubleRepository $meubleRepository): Response
    {
        $meubles = $meubleRepository->findAll();
        return $this->render('chaise/chaise.html.twig', [
            'meubles'=>$meubles
        ]);
    }
}

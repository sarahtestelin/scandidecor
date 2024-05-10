<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\MeubleRepository;
use App\Repository\CategorieRepository;

class ArmoireController extends AbstractController
{
    #[Route('/armoire', name: 'app_armoire')]
    public function armoire(MeubleRepository $meubleRepository): Response
    {
        $meubles = $meubleRepository->findAll();
        return $this->render('armoire/armoire.html.twig', [
            'meubles'=>$meubles
        ]);
    }
}

<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\MeubleRepository;

class BaseController extends AbstractController
{
    #[Route('/', name: 'app_accueil')]
    public function index(MeubleRepository $meubleRepository): Response
    {
        $meubles = $meubleRepository->findBy([], null, 4);

        return $this->render('base/index.html.twig', [
            'nouveautes' => $meubles 
        ]);
    }

    #[Route('/nouveautes', name: 'app_nouveaute')]
    public function nouveautes(MeubleRepository $meubleRepository): Response
    {
        $meubles = $meubleRepository->findAll();
        return $this->render('base/nouveautes.html.twig', [
            'meubles' => $meubles
        ]);
    }
}

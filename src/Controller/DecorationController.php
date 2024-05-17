<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\MeubleRepository;
use App\Repository\CategorieRepository;

class DecorationController extends AbstractController
{
    #[Route('/decoration', name: 'app_decoration')]
    public function decoration(MeubleRepository $meubleRepository): Response
    {
        $meubles = $meubleRepository->findAll();
        return $this->render('decoration/decoration.html.twig', [
            'meubles'=>$meubles
        ]);
    }
}

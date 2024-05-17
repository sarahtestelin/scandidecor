<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\MeubleRepository;
use App\Repository\CategorieRepository;

class TableDeNuitController extends AbstractController
{
    #[Route('/tabledenuit', name: 'app_tabledenuit')]
    public function tabledenuit(MeubleRepository $meubleRepository): Response
    {
        $meubles = $meubleRepository->findAll();
        return $this->render('table_de_nuit/tabledenuit.html.twig', [
            'meubles'=>$meubles
        ]);
    }
}

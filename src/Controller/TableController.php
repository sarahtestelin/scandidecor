<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\MeubleRepository;
use App\Repository\CategorieRepository;

class TableController extends AbstractController
{
    #[Route('/table', name: 'app_table')]
    public function table(MeubleRepository $meubleRepository): Response
    {
        $meubles = $meubleRepository->findAll();
        return $this->render('table/table.html.twig', [
            'meubles'=>$meubles
        ]);
    }
}

<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\MeubleRepository;
use App\Entity\Associer;
use App\Entity\Produit;
use App\Entity\Meuble;
use App\Repository\AssocierRepository;

class ProduitController extends AbstractController
{
    #[Route('/produit/{id}', name: 'app_produit')]
    public function produit(Request $request, Meuble $meuble, AssocierRepository $associerRepository): Response
    {
        $associers = $associerRepository->findAll();
        return $this->render('produit/article.html.twig', [
            'meuble' => $meuble,
            'associer' => $associers
        ]);
    }
}

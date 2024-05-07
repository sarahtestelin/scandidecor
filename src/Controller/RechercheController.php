<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\MeubleRepository;

class RechercheController extends AbstractController
{
    #[Route('/search', name: 'app_search')]
    public function search(Request $request, MeubleRepository $meubleRepository)
    {
        $query = $request->query->get('q');
        $meubles = $meubleRepository->findBySearchQuery($query);

        return $this->render('recherche/results.html.twig', [
            'meubles' => $meubles,
            'query' => $query,
        ]);
    }
}

<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Meuble;
use Doctrine\ORM\EntityManagerInterface;

class FavorisController extends AbstractController
{
    #[Route('/private-favoris/{id}', name: 'app_favoris_produit')]
    public function favoris(Meuble $meuble, EntityManagerInterface $em, Request $request): Response
    {
        
        if ($this->getUser()->getFavoris()->contains($meuble)) {
            $this->getUser()->removeFavori($meuble);
        } else {
            $this->getUser()->addFavori($meuble);
        }
        $em->persist($this->getUser());
        $em->flush();

        
        $redirectUrl = $request->query->get('redirect') ?? $this->generateUrl('app_accueil');
        return $this->redirect($redirectUrl);
    }

    #[Route('/private-suppfavoris/{id}', name: 'app_suppfav')]
    public function suppfav(Meuble $meuble, EntityManagerInterface $em, Request $request): Response
    {
        
        if ($this->getUser()->getFavoris()->contains($meuble)) {
            $this->getUser()->removeFavori($meuble);
        }
        $em->persist($this->getUser());
        $em->flush();

        
        $redirectUrl = $request->query->get('redirect') ?? $this->generateUrl('app_accueil');
        return $this->redirect($redirectUrl);
    }
}

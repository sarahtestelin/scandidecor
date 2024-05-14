<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Panier;
use App\Entity\Ajouter;
use App\Entity\Meuble;
use Doctrine\ORM\EntityManagerInterface;

class PanierController extends AbstractController
{
    #[Route('/ajoutpanier/{id}', name: 'app_ajoutpanier')]
public function panier(Meuble $meuble, EntityManagerInterface $em): Response
{
    $user = $this->getUser();
    
    if ($user === null) {
        return $this->redirectToRoute('app_login');
    }

    $panier = $user->getPanier();

    if (!$panier) {
        $panier = new Panier();
        $panier->setUser($user);
        $em->persist($panier);
    }

    $ajouter = $panier->getAjouters()->filter(function (Ajouter $a) use ($meuble) {
        return $a->getMeuble() === $meuble;
    })->first();

    if (!$ajouter) {
        $ajouter = new Ajouter();
        $ajouter->setQuantite(1);
        $ajouter->setMeuble($meuble);
        $ajouter->setPanier($panier);
        $panier->addAjouter($ajouter);
    } else {
        $ajouter->setQuantite($ajouter->getQuantite() + 1);
    }

    $em->persist($ajouter);
    $em->flush();

    return $this->redirectToRoute('app_accueil');
}


    #[Route('/voirpanier', name: 'app_voirpanier')]
    public function voirpanier(): Response
    {
        return $this->render('panier/voirpanier.html.twig', [
        ]);
    }

    #[Route('/increase/{id}', name: 'increase_quantity')]
    public function increaseQuantity(Meuble $meuble, EntityManagerInterface $em): Response
    {
        $panier = $this->getUser()->getPanier();
        $ajouter = $panier->getAjouters()->filter(function(Ajouter $aj) use ($meuble) {
            return $aj->getMeuble() === $meuble;
        })->first();

        if ($ajouter) {
            $ajouter->setQuantite($ajouter->getQuantite() + 1);
            $em->persist($ajouter);
            $em->flush();
        }

        return $this->redirectToRoute('app_voirpanier');
    }

    #[Route('/decrease/{id}', name: 'decrease_quantity')]
    public function decreaseQuantity(Meuble $meuble, EntityManagerInterface $em): Response
    {
        $panier = $this->getUser()->getPanier();
        $ajouter = $panier->getAjouters()->filter(function(Ajouter $aj) use ($meuble) {
            return $aj->getMeuble() === $meuble;
        })->first();

        if ($ajouter && $ajouter->getQuantite() > 1) {
            $ajouter->setQuantite($ajouter->getQuantite() - 1);
            $em->persist($ajouter);
            $em->flush();
        } else {
            $em->remove($ajouter);
            $em->flush();
        }

        return $this->redirectToRoute('app_voirpanier');
    }

    #[Route('/remove/{id}', name: 'remove_from_cart')]
    public function removeFromCart(Meuble $meuble, EntityManagerInterface $em): Response
    {
        $panier = $this->getUser()->getPanier();
        $ajouter = $panier->getAjouters()->filter(function(Ajouter $aj) use ($meuble) {
            return $aj->getMeuble() === $meuble;
        })->first();

        if ($ajouter) {
            $panier->removeAjouter($ajouter);
            $em->remove($ajouter);
            $em->flush();
        }

        return $this->redirectToRoute('app_voirpanier');
    }
    

}



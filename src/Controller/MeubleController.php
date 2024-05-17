<?php

namespace App\Controller;

use App\Entity\Meuble;
use App\Form\MeubleType;
use App\Repository\MeubleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/meuble')]
class MeubleController extends AbstractController
{
    #[Route('/', name: 'meuble_manage', methods: ['GET', 'POST'])]
    public function manage(Request $request, MeubleRepository $meubleRepository): Response
    {
       
        $isAdmin = $this->isGranted('ROLE_ADMIN');

        $meuble = new Meuble();
        $form = $this->createForm(MeubleType::class, $meuble);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $meubleRepository->add($meuble, true);
            $this->addFlash('success', 'Meuble sauvegardé avec succès!');
            return $this->redirectToRoute('meuble_manage');
        }

        $meubles = $meubleRepository->findAll();
        return $this->render('meuble/manage.html.twig', [
            'meubles' => $meubles,
            'form' => $form->createView(),
            'is_admin' => $isAdmin, 
            'edit' => false, 
        ]);
    }

    #[Route('/edit/{id}', name: 'meuble_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Meuble $meuble, MeubleRepository $meubleRepository): Response
    {
        $isAdmin = $this->isGranted('ROLE_ADMIN');

        $form = $this->createForm(MeubleType::class, $meuble);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $meubleRepository->add($meuble, true);
            $this->addFlash('success', 'Meuble modifié avec succès!');
            return $this->redirectToRoute('meuble_manage');
        }

        $meubles = $meubleRepository->findAll();
        return $this->render('meuble/manage.html.twig', [
            'meubles' => $meubles,
            'form' => $form->createView(),
            'is_admin' => $isAdmin,
            'edit' => true, 
        ]);
    }

    #[Route('/delete/{id}', name: 'meuble_delete', methods: ['POST'])]
    public function delete(Request $request, Meuble $meuble, MeubleRepository $meubleRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$meuble->getId(), $request->request->get('_token'))) {
            $meubleRepository->remove($meuble, true);
            $this->addFlash('success', 'Meuble supprimé avec succès!');
        }
        return $this->redirectToRoute('meuble_manage');
    }
}

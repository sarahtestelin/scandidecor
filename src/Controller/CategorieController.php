<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Form\CategorieType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class CategorieController extends AbstractController
{
    #[Route('/admin-listecategorie', name: 'app_listecategorie')]
    public function listecategorie(Request $request, EntityManagerInterface $entityManager, Security $security): Response
    {
        $is_admin = $security->isGranted('ROLE_ADMIN');
        if (!$is_admin) {
            return $this->render('categorie/access_denied.html.twig');
        }

        $categories = $entityManager->getRepository(Categorie::class)->findAll();
        
        $categorie = new Categorie();
        $form = $this->createForm(CategorieType::class, $categorie);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($categorie);
            $entityManager->flush();
            return $this->redirectToRoute('app_listecategorie');
        }

        if ($request->isMethod('POST') && $request->request->has('delete')) {
            $id = $request->request->get('delete');
            $categorieToDelete = $entityManager->getRepository(Categorie::class)->find($id);
            if ($categorieToDelete) {
                $entityManager->remove($categorieToDelete);
                $entityManager->flush();
                return $this->redirectToRoute('app_listecategorie');
            }
        }

        return $this->render('categorie/listecategorie.html.twig', [
            'categories' => $categories,
            'form' => $form->createView(),
            'is_admin' => $is_admin,
        ]);
    }
}

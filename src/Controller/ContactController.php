<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function contact(Request $request, EntityManagerInterface $em): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $em->persist($contact);
                $em->flush();
                $this->addFlash('notice', 'Message envoyé');
                return $this->redirectToRoute('app_contact');
            }
        }
        return $this->render('contact/contact.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    #[Route('/mentionslegales', name: 'app_mentionslegales')]
    public function mentionslegales(): Response
    {
        return $this->render('contact/mentionslegales.html.twig', [
        ]);
    }
}

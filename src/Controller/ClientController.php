<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserRepository;
use Symfony\Component\Security\Core\Security;

class ClientController extends AbstractController
{
    #[Route('/client/{id}', name: 'app_client')]
    public function client(Security $security): Response
    {
        $user = $security->getUser();
        if (!$user) {
            return $this->redirectToRoute('login');
        }
        return $this->render('client/client.html.twig', [
            'user' => $user,
        ]);
    }
}
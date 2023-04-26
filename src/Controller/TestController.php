<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Csrf\TokenStorage\TokenStorageInterface;

class TestController extends AbstractController
{
    private $tokenStorage;

    #[Route('/test', name: 'app_test')]
    public function index(TokenStorageInterface $tokenStorage): Response
    {
        $this->tokenStorage = $tokenStorage;
        $user = $this->tokenStorage->getToken()->getUser();
        $id = $user->getId();

        return $this->render('test/index.html.twig', [
            'controller_name' => 'TestController',
            'id' => $id,
        ]);
    }
}

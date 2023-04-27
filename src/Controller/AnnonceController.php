<?php

namespace App\Controller;

use App\Entity\Annonce;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AnnonceController extends AbstractController
{
    #[Route('/annonce/{id}', name: 'app_annonce')]
    public function index(Annonce $annonce): Response
    {
        return $this->render('annonce/index.html.twig', [
            'annonce' => $annonce,
        ]);
    }
}

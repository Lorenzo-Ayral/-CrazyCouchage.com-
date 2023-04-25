<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Annonce;
use App\Form\CreateAnnonceType;

class CreateAnnonceController extends AbstractController
{
    #[Route('/create-annonce', name: 'app_create_annonce')]
    public function createAnnonce(Request $request): Response
    {
        $annonce = new Annonce();
        $annonce->setUser($this->getUser());
        $form = $this->createForm(CreateAnnonceType::class, $annonce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Enregistrer la nouvelle annonce dans la base de données
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($annonce);
            $entityManager->flush();

            // Rediriger vers une page de confirmation ou autre
            return $this->redirectToRoute('/');
        }

        return $this->render('create_annonce/index.html.twig', [
            'CreateAnnonceForm' => $form->createView(),
        ]);
    }

    public function handleFormSubmission(Request $request): \Symfony\Component\HttpFoundation\RedirectResponse|Response
    {
        $annonce = new Annonce();
        $form = $this->createForm(AnnonceType::class, $annonce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Enregistrer la nouvelle annonce dans la base de données
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($annonce);
            $entityManager->flush();

            // Rediriger vers une page de confirmation ou autre
            return $this->redirectToRoute('app_create_annonce');
        }

        return $this->render('create_annonce/index.html.twig', [
            'CreateAnnonceForm' => $form->createView(),
        ]);
    }
}

<?php

namespace App\Controller;

use App\Entity\Logement;
use App\Form\LogementType;
use App\Repository\LogementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/logement')]
class LogementController extends AbstractController
{
    #[Route('/', name: 'app_logement_index', methods: ['GET'])]
    public function index(LogementRepository $logementRepository): Response
    {
        return $this->render('logement/index.html.twig', [
            'logements' => $logementRepository->findAll(),
        ]);
    }

    #[Route('/admin/creer', name: 'app_logement_new', methods: ['GET', 'POST'])]
    public function new(Request $request, LogementRepository $logementRepository): Response
    {
        $logement = new Logement();
        $form = $this->createForm(LogementType::class, $logement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $logementRepository->save($logement, true);

            return $this->redirectToRoute('app_logement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('logement/new.html.twig', [
            'logement' => $logement,
            'form' => $form,
        ]);
    }

    #[Route('/admin/{id}', name: 'app_logement_show', methods: ['GET'])]
    public function show(Logement $logement): Response
    {
        return $this->render('logement/show.html.twig', [
            'logement' => $logement,
        ]);
    }

    #[Route('/admin/{id}/editer', name: 'app_logement_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Logement $logement, LogementRepository $logementRepository): Response
    {
        $form = $this->createForm(LogementType::class, $logement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $logementRepository->save($logement, true);

            return $this->redirectToRoute('app_logement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('logement/edit.html.twig', [
            'logement' => $logement,
            'form' => $form,
        ]);
    }

    #[Route('/admin/{id}', name: 'app_logement_delete', methods: ['POST'])]
    public function delete(Request $request, Logement $logement, LogementRepository $logementRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$logement->getId(), $request->request->get('_token'))) {
            $logementRepository->remove($logement, true);
        }

        return $this->redirectToRoute('app_logement_index', [], Response::HTTP_SEE_OTHER);
    }
}

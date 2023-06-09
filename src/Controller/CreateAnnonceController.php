<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Annonce;
use App\Form\CreateAnnonceType;
use App\Repository\AnnonceRepository;
use App\Service\RegisterImage;

class CreateAnnonceController extends AbstractController
{
    #[Route('/admin/creer-annonce', name: 'app_create_annonce')]
    public function createAnnonce(Request $request, AnnonceRepository $annonceRepository): Response
    {
        $annonce = new Annonce();
        $annonce->setUser($this->getUser());
        $form = $this->createForm(CreateAnnonceType::class, $annonce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $registerFile = new RegisterImage($form);
            $fileName = $registerFile->saveImage();

            $file = $form['image']->getData();
           // use the original file name
            $file->move('image_directory', $file->getClientOriginalName());
    

            $annonce->setImage($file->getClientOriginalName());
            $annonceRepository->save($annonce, true);

            // Rediriger vers une page de confirmation ou autre
            return $this->redirectToRoute('app_home');
        }

        return $this->render('create_annonce/index.html.twig', [
            'CreateAnnonceForm' => $form->createView(),
        ]);
    }
}
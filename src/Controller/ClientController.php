<?php

namespace App\Controller;

use App\Repository\CliniqueRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClientController extends AbstractController
{
    #[Route('/acceuilClient', name: 'app_client')]
    public function index(): Response
    {
        return $this->render('client/index.html.twig', [
        ]);
    }

    #[Route('/acceuilClient/urgence', name: 'app_client_urgence')]
    public function indexUrgence(): Response
    {
        return $this->render('client/index_urgence.html.twig', [
        ]);
    }

    #[Route('/acceuilClient/contact', name: 'app_client_contact')]
    public function indexContact(CliniqueRepository $cliniqueRepository): Response
    {
        $clinique = $cliniqueRepository->findAll();

        return $this->render('client/index_contact.html.twig', [
            'clinique' => $clinique,
        ]);
    }

    #[Route('/acceuilClient/faq', name: 'app_client_faq')]
    public function indexFaq(): Response
    {
        return $this->render('client/index_faq.html.twig', [
            'controller_name' => 'ClientController',
        ]);
    }
}

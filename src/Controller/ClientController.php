<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ClientController extends AbstractController
{
    #[Route('/', name: 'app_client')]
    public function index(): Response
    {
        return $this->render('client/index.html.twig', [
            'controller_name' => 'ClientController',
        ]);
    }

    #[Route('/acceuilClient/rdv', name: 'app_client_rendezvous')]
    public function indexRdv(): Response
    {
        return $this->render('client/index_rdv.html.twig', [
            'controller_name' => 'ClientController',
        ]);
    }

    #[Route('/acceuilClient/urgence', name: 'app_client_urgence')]
    public function indexUrgence(): Response
    {
        return $this->render('client/index_urgence.html.twig', [
            'controller_name' => 'ClientController',
        ]);
    }

    #[Route('/acceuilClient/contact', name: 'app_client_contact')]
    public function indexContact(): Response
    {
        return $this->render('client/index_contact.html.twig', [
            'controller_name' => 'ClientController',
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

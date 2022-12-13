<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VeterinaireController extends AbstractController
{
    #[Route('/veterinaire', name: 'app_veterinaire')]
    public function index(): Response
    {
        return $this->render('veterinaire/index.html.twig', [
            'current_page' => '',
        ]);
    }

    #[Route('/veterinaire/planning', name: 'app_veterinaire_planning')]
    public function indexPlanning(): Response
    {
        return $this->render('veterinaire/index_planning.html.twig', [
            'current_page' => 'planning',
        ]);
    }

    #[Route('/veterinaire/rdv', name: 'app_veterinaire_rdv')]
    public function indexRdv(): Response
    {
        return $this->render('veterinaire/index_rdv.html.twig', [
        ]);
    }

    #[Route('/veterinaire/clients', name: 'app_veterinaire_clients')]
    public function indexClients(): Response
    {
        return $this->render('veterinaire/index_clients.html.twig', [
        ]);
    }

    #[Route('/veterinaire/infos', name: 'app_veterinaire_infos')]
    public function indexInfos(): Response
    {
        return $this->render('veterinaire/index_infos.html.twig', [
        ]);
    }
}

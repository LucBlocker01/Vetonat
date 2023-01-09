<?php

namespace App\Controller;

use App\Repository\PersonneRepository;
use App\Repository\VeterinaireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class VeterinaireController extends AbstractController
{
    #[Route('/veterinaire', name: 'app_veterinaire')]
    public function index(Security $security, VeterinaireRepository $repository): Response
    {
        $user = $security->getUser();
        $veterinaire = $repository->findOneBy(['personne' => $user->getId()]);

        return $this->render('veterinaire/index.html.twig', [
            'consultations' => $veterinaire->getConsultations(),
            'current_page' => 'app_veterinaire',
            'user' => $user,
        ]);
    }

    #[Route('/veterinaire/planning', name: 'app_veterinaire_planning')]
    public function indexPlanning(Security $security): Response
    {
        return $this->render('veterinaire/index_planning.html.twig', [
            'current_page' => 'planning',
            'user' => $security->getUser(),
        ]);
    }

    #[Route('/veterinaire/rdv', name: 'app_veterinaire_rdv')]
    public function indexRdv(Security $security): Response
    {
        return $this->render('veterinaire/index_infos_rdv.html.twig', [
            'user' => $security->getUser(),
        ]);
    }

    #[Route('/veterinaire/clients', name: 'app_veterinaire_clients')]
    public function indexClients(Security $security, Request $request, PersonneRepository $clientRepository): Response
    {
        $recherche = $request->query->get('search', '');
        $tableau = $clientRepository->search($recherche);

        return $this->render('veterinaire/index_clients.html.twig',
            ['lstContact' => $tableau, 'search' => $recherche, 'user' => $security->getUser()]);
    }

    #[Route('/veterinaire/infos', name: 'app_veterinaire_infos')]
    public function indexInfos(Security $security): Response
    {
        return $this->render('veterinaire/index_infos.html.twig', ['user' => $security->getUser(),
        ]);
    }

    #[Route('/veterinaire/infos_rdv', name: 'app_veterinaire_infos_rdv')]
    public function indexInfosRdv(Security $security): Response
    {
        return $this->render('veterinaire/index_infos_rdv.html.twig', ['veterinaire' => $security->getUser(),
        ]);
    }

    #[Route('/veterinaire/infos_trmts', name: 'app_veterinaire_traitements')]
    public function infoTraitement(): Response
    {
        return $this->render('veterinaire/infos_trtmts.html.twig');
    }
}

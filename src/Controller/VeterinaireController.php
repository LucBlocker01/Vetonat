<?php

namespace App\Controller;

use App\Repository\ConsultationRepository;
use App\Repository\VeterinaireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
        ]);
    }

    #[Route('/veterinaire/planning', name: 'app_veterinaire_planning')]
    public function indexPlanning(ConsultationRepository $repot): Response
    {
        $event = $repot->findAll();
        $rdvs = [];
        foreach ($event as $ev) {
            $rdvs[] = [
                'id' => $ev->getId(),
                'start' => $ev->getStart()->format('Y-m-d H:i:s'),
                'end' => $ev->getEnd()->format('Y-m-d H:i:s'),
                'title' => $ev->getMotifConsultation(),
                'description' => $ev->getConsultationDesc(),
                'allDay' => $ev->getAllDay(),
                'backgroundColor' => $ev->getBackgroundColor(),
            ];
        }

        $data = json_encode($rdvs);
        return $this->render('/veterinaire/index_planning.html.twig', compact('data'));

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

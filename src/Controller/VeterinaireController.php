<?php

namespace App\Controller;

use App\Repository\ConsultationRepository;
use App\Repository\PersonneRepository;
use Doctrine\Persistence\ManagerRegistry;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class VeterinaireController extends AbstractController
{
    #[Route('/veterinaire/planning', name: 'app_veterinaire_planning')]
    #[IsGranted('ROLE_ADMIN')]
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
    #[IsGranted('ROLE_ADMIN')]
    public function indexRdv(Security $security): Response
    {
        return $this->render('veterinaire/index_infos_rdv.html.twig', [
            'user' => $security->getUser(),
        ]);
    }

    #[Route('/veterinaire/clients', name: 'app_veterinaire_clients')]
    #[IsGranted('ROLE_ADMIN')]
    public function indexClients(Security $security, Request $request, PersonneRepository $clientRepository): Response
    {
        $recherche = $request->query->get('search', '');
        $tableau = $clientRepository->search($recherche);

        return $this->render('veterinaire/index_clients.html.twig',
            ['lstContact' => $tableau, 'search' => $recherche, 'user' => $security->getUser()]);
    }

    #[Route('/veterinaire/infos', name: 'app_veterinaire_infos')]
    #[IsGranted('ROLE_ADMIN')]
    public function indexInfos(Security $security): Response
    {
        return $this->render('veterinaire/index_infos.html.twig', ['user' => $security->getUser(),
        ]);
    }

    #[Route('/veterinaire/{id}/infos_rdv', name: 'app_veterinaire_infos_rdv', requirements: ['id' => '\d+'])]
    #[IsGranted('ROLE_ADMIN')]
    public function indexInfosRdv(Security $security, int $id, ConsultationRepository $consultationRepository): Response
    {
        $consult = $consultationRepository->findOneBy(['id' => $id]);
        $client = $consult->getAnimal()->getClient()->getPersonne();
        $animal = $consult->getAnimal();

        return $this->render('veterinaire/index_infos_rdv.html.twig', ['veterinaire' => $security->getUser(), 'consultation' => $consult, 'client' => $client, 'animal' => $animal,
        ]);
    }

    #[Route('veterinaire/{id}/add', name: 'app_veterinaire_add_consultation')]
    #[IsGranted('ROLE_ADMIN')]
    public function addCons(int $id, ManagerRegistry $doctrine, ConsultationRepository $cons, Security $security): Response
    {
        $veto = $security->getUser()->getVeterinaire();
        $consultation = $cons->findOneBy(['id' => $id]);
        $consultation->setVeterinaire($veto);
        $entityManager = $doctrine->getManager();
        $entityManager->persist($consultation);
        $entityManager->flush();
        return $this->redirectToRoute('app_client');
    }
}

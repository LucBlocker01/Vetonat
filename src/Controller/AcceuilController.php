<?php

namespace App\Controller;

use App\Repository\AnimalRepository;
use App\Repository\ConsultationRepository;
use App\Repository\PersonneRepository;
use App\Repository\VeterinaireRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class AcceuilController extends AbstractController
{
    #[Route('/acceuil', name: 'app_acceuil')]
    public function index(): Response
    {
        return $this->render('acceuil/index.html.twig', []);
    }

    #[IsGranted('ROLE_USER')]
    #[Route('/acceuilConnecté', name: 'app_client')]
    public function acceuilCo(Security $security, AnimalRepository $animalRepository, PersonneRepository $PersonneRepository, ConsultationRepository $consultationRepository): Response
    {
        $user = $security->getUser();
        $personne = $PersonneRepository->findOneBy(['loginPers' => $user->getUserIdentifier()]);
        if ($personne->getClient()) {
            $animaux = $personne->getClient()->getAnimal();
            $lstConsult = [];
            foreach ($animaux as $animal) {
                $valid = [];
                $animalConsultation = $animal->getConsultation();
                foreach ($animalConsultation as $consult) {
                    if ($consult->getStart() < new \DateTime()) {
                        $valid[] = $consult;
                    }
                }
                $lstConsult = array_merge($lstConsult, $valid);
            }

            return $this->render('client/index.html.twig', [
                'user' => $personne,
                'animaux' => $animaux,
                'consultations' => $lstConsult,
            ]);
        } else {
            return $this->render('client/index.html.twig', [
                'user' => $personne,
            ]);
        }
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/acceuilConnecté', name: 'app_client')]
    public function acceuilCoVeto(Security $security, VeterinaireRepository $repository): Response
    {
        $user = $security->getUser();
        $veterinaire = $repository->findOneBy(['personne' => $user->getId()]);

        return $this->render('veterinaire/index.html.twig', [
            'consultations' => $veterinaire->getConsultations(),
            'current_page' => 'app_veterinaire',
        ]);
    }
}

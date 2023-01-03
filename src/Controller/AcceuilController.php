<?php

namespace App\Controller;

use App\Repository\AnimalRepository;
use App\Repository\ConsultationRepository;
use App\Repository\PersonneRepository;
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

    #[Route('/acceuilConnecté', name: 'app_client')]
    public function acceuilCo(Security $security, AnimalRepository $animalRepository, PersonneRepository $PersonneRepository, ConsultationRepository $consultationRepository): Response
    {
        $user = $security->getUser();
        $personne = $PersonneRepository->findOneBy(['loginPers' => $user->getUserIdentifier()]);
        if ($personne->getClient()) {
            $animaux = $personne->getClient()->getAnimal();
            $lstConsult = [];
            foreach ($animaux as $animal) {
                $consultations = $consultationRepository->findBy(['id' => $animal->getId()]);
                $lstConsult[] = $consultations;
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
}

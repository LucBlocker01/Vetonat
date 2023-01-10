<?php

namespace App\Controller;

use App\Repository\AnimalRepository;
use App\Repository\ConsultationRepository;
use App\Repository\PersonneRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class AcceuilController extends AbstractController
{
    #[Route('/accueil', name: 'app_acceuil')]
    public function index(): Response
    {
        return $this->render('acceuil/index.html.twig', []);
    }

    #[IsGranted('ROLE_USER')]
    #[Route('/home', name: 'app_client')]
    public function acceuilCo(Security $security, AnimalRepository $animalRepository, PersonneRepository $PersonneRepository, ConsultationRepository $consultationRepository): Response
    {
        $user = $security->getUser();
        $personne = $PersonneRepository->findOneBy(['loginPers' => $user->getUserIdentifier()]);
        // si c'est un véto
        if ($personne->getVeterinaire()) {
            $veterinaire = $personne->getVeterinaire();
            $consultations = $consultationRepository->findBy(['veterinaire' => $veterinaire], ['start' => 'ASC']);
            $consdujour = [];
            $date = date('d/m/Y');
            foreach ($consultations as $conselement) {
                if ($conselement->getStart()->format('d/m/Y') == $date) {
                    $consdujour[] = $conselement;
                }
            }

            return $this->render('veterinaire/index.html.twig', [
                'consultations' => $consdujour,
                'current_page' => 'app_veterinaire',
            ]);
        }
        // Si c'est un client
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
}

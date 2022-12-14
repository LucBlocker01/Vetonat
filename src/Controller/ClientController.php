<?php

namespace App\Controller;

use App\Entity\Client;
use App\Repository\AnimalRepository;
use App\Repository\CliniqueRepository;
use App\Repository\ConsultationRepository;
use App\Repository\PersonneRepository;
use Doctrine\Persistence\ManagerRegistry;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use App\Repository\VeterinaireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class ClientController extends AbstractController
{

    #[Route('/acceuilClient', name: 'app_client')]
    public function index(Security $security, AnimalRepository $animalRepository, PersonneRepository $PersonneRepository, ConsultationRepository $consultationRepository): Response
    {
        $user = $security->getUser();
        $personne = $PersonneRepository->findOneBy(['loginPers' => $user->getUserIdentifier()]);
        $animaux = $personne->getClient()->getAnimal();
        $lstConsult = [];
        foreach ($animaux as $animal) {
            $consultations = $consultationRepository->findBy(['id' => $animal->getId()]);
            array_push($lstConsult, $consultations);
        }

        return $this->render('client/index.html.twig', [
            'user' => $personne,
            'animaux' => $animaux,
        ]);
    }

    #[Route('/acceuilClient/urgence', name: 'app_client_urgence')]
    public function indexUrgence(): Response
    {
        return $this->render('client/index_urgence.html.twig', [
        ]);
    }

    #[Route('/acceuilClient/contact', name: 'app_client_contact')]
    public function indexContact(CliniqueRepository $cliniqueRepository, VeterinaireRepository $veterinaireRepository): Response
    {
        $cliniques = $cliniqueRepository->findAll();
        $veterinaires = $veterinaireRepository->findAll();

        return $this->render('client/index_contact.html.twig', [
            'cliniques' => $cliniques,
            'veterinaires' => $veterinaires,
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

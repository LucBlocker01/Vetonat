<?php

namespace App\Controller;

use App\Repository\CliniqueRepository;
use App\Repository\VeterinaireRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class ClientController extends AbstractController
{
    #[Route('/client/urgence', name: 'app_client_urgence')]
    #[IsGranted('ROLE_USER')]
    public function indexUrgence(Security $security): Response
    {
        return $this->render('client/index_urgence.html.twig', ['user' => $security->getUser(),
        ]);
    }

    #[Route('/client/contact', name: 'app_client_contact')]
    #[IsGranted('ROLE_USER')]
    public function indexContact(Security $security, CliniqueRepository $cliniqueRepository, VeterinaireRepository $veterinaireRepository): Response
    {
        $cliniques = $cliniqueRepository->findAll();
        $veterinaires = $veterinaireRepository->findAll();

        return $this->render('client/index_contact.html.twig', [
            'cliniques' => $cliniques,
            'veterinaires' => $veterinaires,
            'user' => $security->getUser(),
        ]);
    }

    #[Route('/client/faq', name: 'app_client_faq')]
    #[IsGranted('ROLE_USER')]
    public function indexFaq(Security $security): Response
    {
        return $this->render('client/index_faq.html.twig', [
            'user' => $security->getUser(),
        ]);
    }
}

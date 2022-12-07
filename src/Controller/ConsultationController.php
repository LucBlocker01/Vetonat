<?php

namespace App\Controller;


use App\Entity\Consultation;
use App\Form\ConsultationType;
use App\Repository\ConsultationRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConsultationController extends AbstractController
{
    #[Route('/consultation', name: 'app_consultation')]
    public function index(ConsultationRepository $repot): Response
    {
        $consultation = $repot->findBy([]);
        return $this->render('consultation/index.html.twig', [
            'consultations' => $consultation,
        ]);
    }

    #[Route('/create/consultation', name: 'app_create_consultation')]
    public function create(ManagerRegistry $doctrine, Request $requete): Response
    {
        $consultation = new Consultation();
        $entityManager = $doctrine->getManager();
        $form = $this->createForm(ConsultationType::class, $consultation);
        $form->handleRequest($requete);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($consultation);
            $entityManager->flush();
            return $this->redirectToRoute('app_consultation');
        }

        return $this->renderForm('consultation/create.html.twig', ['consultation' => $consultation, 'form' => $form]);
    }
}

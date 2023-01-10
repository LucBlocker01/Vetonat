<?php

namespace App\Controller;


use App\Entity\Consultation;
use App\Form\ConsultationType;
use App\Repository\ConsultationRepository;
use Doctrine\Persistence\ManagerRegistry;
use http\Client\Curl\User;
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

    #[Route('consultation/create', name: 'app_create_consultation')]
    public function create(ManagerRegistry $doctrine, Request $requete): Response
    {
        $consultation = new Consultation();
        $form = $this->createForm(ConsultationType::class, $consultation);
        $form->handleRequest($requete);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $doctrine->getManager();
            $entityManager->persist($consultation);
            $entityManager->flush();
            return $this->redirectToRoute('app_consultation');
        }

        return $this->renderForm('consultation/create.html.twig', ['consultation' => $consultation, 'form' => $form]);
    }

    #[Route('/consultation/test', name: 'app_consultation_test')]
    public function test(ConsultationRepository $repot): Response
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
            return $this->render('consultation/test.html.twig', compact('data'));
    }
}
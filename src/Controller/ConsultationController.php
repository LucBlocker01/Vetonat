<?php

namespace App\Controller;


use App\Entity\Consultation;
use App\Form\ConsultationType;
use App\Repository\ConsultationRepository;
use Doctrine\Persistence\ManagerRegistry;
use http\Client\Curl\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
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
    public function create(ManagerRegistry $doctrine, Request $requete,ConsultationRepository $repot): Response
    {
        $consultation = new Consultation();
        $form = $this->createForm(ConsultationType::class, $consultation);
        $form->handleRequest($requete);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $doctrine->getManager();
            $entityManager->persist($consultation);
            $entityManager->flush();
            return $this->redirectToRoute('app_client');
        }

        return $this->renderForm('consultation/create.html.twig', ['consultation' => $consultation, 'form' => $form]);
    }

    #[Route('/consultation/Planning_cacher', name: 'app_consultation_planning_cacher')]
    public function PlanningCacher(ConsultationRepository $repot): Response
    {
            $event = $repot->findAll();
            $rdvs = [];
            foreach ($event as $ev) {
                $rdvs[] = [
                    'id' => $ev->getId(),
                    'start' => $ev->getStart()->format('Y-m-d H:i:s'),
                    'end' => $ev->getEnd()->format('Y-m-d H:i:s'),
                    'title' => 'Réserver',
                    'description' => $ev->getConsultationDesc(),
                    'allDay' => $ev->getAllDay(),
                    'backgroundColor' => '#000000',
                ];
            }

            $data = json_encode($rdvs);
            return $this->render('consultation/Planning_cacher.html.twig', compact('data'));
    }

    #[Route('/consultation/{id}/update', name: 'app_consultation_update')]
    public function update(ManagerRegistry $doctrine, Consultation $consultation, Request $request)
    {
        $form = $this->createForm(ConsultationType::class, $consultation);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $doctrine->getManager();
            $entityManager->persist($consultation);
            /** @var Consultation $editConsul */
            $editContact = $form->getData();
            $entityManager->flush();

            return $this->redirectToRoute('app_client', [
                'id' => $editContact->getId(),
            ]);
        }

        return $this->renderForm('consultation/updateconsul.html.twig', [
            'animal' => $consultation,
            'form' => $form,
        ]);
    }

    #[Route('/consultation/{id}/delete', name: 'app_consultation_delete', requirements: ['id' => '\d+'])]
    public function delete(Consultation $consultation, Request $request, ManagerRegistry $doctrine)
    {
        $form = $this->createFormBuilder($consultation)
            ->add('Supprimer', SubmitType::class, ['label' => 'Supprimer'])
            ->add('Annuler', SubmitType::class, ['label' => 'Annuler'])
            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if ($form->get('Supprimer')->isClicked()) {
                $entityManager = $doctrine->getManager();
                $entityManager->remove($consultation);
                $entityManager->flush();

                return $this->redirectToRoute('app_client');
            } else {
                return $this->redirectToRoute('app_client', [
                    'id' => $consultation->getId()
                ]);
            }
        } else {
            return $this->render('consultation/deleteconsul.html.twig', [
                'consultation' => $consultation,
                'form' => $form->createView(),
            ]);
        }
    }
}
<?php

namespace App\Controller;

use App\Repository\ConsultationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
}

<?php

namespace App\Controller;

use App\Entity\Personne;
use App\Repository\PersonneRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PersonneController extends AbstractController
{
    #[Route('/client', name: 'app_personne')]
    public function index(Request $request, PersonneRepository $clientRepository): Response
    {
        $recherche = $request->query->get('search', '');

        $tableau = $clientRepository->search($recherche);

        return $this->render('personne/index.html.twig', ['lstContact' => $tableau, 'search' => $recherche]);
    }

    #[Route('/client')]
    #[Entity('Personne')]
    public function show(Personne $personne): Response
    {
        return $this->render('personne/index.html.twig', ['Personne' => $personne]);
    }
}

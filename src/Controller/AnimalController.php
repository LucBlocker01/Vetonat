<?php

namespace App\Controller;

use App\Entity\Animal;
use App\Entity\Client;
use App\Repository\AnimalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AnimalController extends AbstractController
{
    #[Route('/client/{id}', name: 'app_animal')]
    public function index(AnimalRepository $AnimalRepository, Request $request, Client $client): Response
    {

        $listAnimal = $client->getAnimal();
        /*$search = $animal->getClient()->getId();
        if (null == $search) {
            $search = '';
        }
        $listAnimal = $AnimalRepository->search($search);*/

        return $this->render('animal/index.html.twig', [
            'lstAnimal' => $listAnimal,
        ]);
    }

    #[Route('/client/{cli_id}/{id}', name: 'app_animal_show')]
    public function show(Animal $animal): Response
    {
        return $this->render('animal/show.html.twig', [
            'animal' => $animal,
            'lstConsult' => $animal->getConsultation(),
        ]);
    }
}

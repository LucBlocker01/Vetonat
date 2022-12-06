<?php

namespace App\Controller;

use App\Entity\Animal;
use App\Repository\AnimalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AnimalController extends AbstractController
{
    #[Route('/client/{id}', name: 'app_animal')]
    public function index(AnimalRepository $AnimalRepository, Request $request, Animal $animal): Response
    {
        // $listContacts = $contactRepository->findBy(array(), array('lastname' => 'ASC', 'firstname' => 'ASC'));
        $search = $animal->getClient()->getId();
        if (null == $search) {
            $search = '';
        }
        $listAnimal = $AnimalRepository->search($search);

        return $this->render('animal/index.html.twig', [
            'lstAnimal' => $listAnimal,
        ]);
    }
}

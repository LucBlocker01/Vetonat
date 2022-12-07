<?php

namespace App\Controller;

use App\Entity\Animal;
use App\Entity\Client;
use App\Entity\Contact;
use App\form\AnimalType;
use App\Form\ContactType;
use App\Repository\AnimalRepository;
use Doctrine\Persistence\ManagerRegistry;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AnimalController extends AbstractController
{
    #[Route('/client/{clientId}/animal', name: 'app_animal')]
    public function index(AnimalRepository $AnimalRepository, int $clientId): Response
    {
        $listAnimal = $AnimalRepository->findByClient($clientId);
        /*$search = $animal->getClient()->getId();
        if (null == $search) {
            $search = '';
        }
        $listAnimal = $AnimalRepository->search($search);*/

        return $this->render('animal/index.html.twig', [
            'lstAnimal' => $listAnimal,
        ]);
    }

    #[Route('/animal/{id}', name: 'app_animal_show')]
    public function show(Animal $animal): Response
    {
        return $this->render('animal/show.html.twig', [
            'animal' => $animal,
            'lstConsult' => $animal->getConsultation(),
        ]);
    }

    #[Route('/client/{cli_id}/{id}/update', name: 'app_contact_update')]
    #[ParamConverter('animal', options: ['mapping' => ['id' => 'id']])]
    public function update(ManagerRegistry $doctrine, Animal $animal, Request $request)
    {
        $form = $this->createForm(AnimalType::class, $animal);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $doctrine->getManager();
            $entityManager->persist($animal);
            /** @var Animal $editAnimal */
            $editContact = $form->getData();
            $entityManager->flush();

            return $this->redirectToRoute('app_animal_show', [
                'id' => $editContact->getId(),
            ]);
        }

        return $this->renderForm('animal/update.html.twig', [
            'animal' => $animal,
            'form' => $form,
        ]);
    }
}

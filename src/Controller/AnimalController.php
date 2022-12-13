<?php

namespace App\Controller;

use App\Entity\Animal;
use App\Entity\Client;
use App\Form\AnimalType;
use App\Repository\AnimalRepository;
use Doctrine\Persistence\ManagerRegistry;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
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
            'clientId' => $clientId,
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

    #[Route('/animal/{id}/update', name: 'app_animal_update')]
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

    #[Route('/client/{id}/animal/create', name: 'app_animal_create', requirements: ['id' => '\d+'])]
    public function create(ManagerRegistry $doctrineContact, Request $request, Client $client)
    {
        $animal = new Animal();
        $animal->setClient($client);
        $form = $this->createForm(AnimalType::class, $animal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $doctrineContact->getManager();
            $entityManager->persist($animal);
            /* @var Animal $editContact */
            $entityManager->flush();

            return $this->redirectToRoute('app_animal', ['clientId' => $client->getId()]);
        }

        return $this->renderForm('animal/create.html.twig', [
            'animal' => $animal,
            'form' => $form,
        ]);
    }

    #[Route('/animal/{id}/delete', name: 'app_animal_delete', requirements: ['id' => '\d+'])]
    public function delete(Animal $animal, Request $request, ManagerRegistry $doctrine)
    {
        $form = $this->createFormBuilder($animal)
            ->add('Supprimer', SubmitType::class, ['label' => 'Supprimer'])
            ->add('Annuler', SubmitType::class, ['label' => 'Annuler'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($form->get('Supprimer')->isClicked()) {
                $entityManager = $doctrine->getManager();
                $entityManager->remove($animal);
                $entityManager->flush();

                return $this->redirectToRoute('app_animal', ['clientId' => $animal->getClient()->getId()]);
            } else {
                return $this->redirectToRoute('app_animal_show', [
                    'id' => $animal->getId(),
                ]);
            }
        } else {
            return $this->render('animal/delete.html.twig', [
                'animal' => $animal,
                'form' => $form->createView(),
            ]);
        }
    }
}

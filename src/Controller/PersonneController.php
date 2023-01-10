<?php

namespace App\Controller;

use App\Factory\PersonneFactory;
use App\Entity\Client;
use App\Entity\Personne;
use App\Form\PersonneType;
use App\Form\PersonneTypeCreate;
use App\Repository\PersonneRepository;
use Doctrine\Persistence\ManagerRegistry;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class PersonneController extends AbstractController
{
    #[Route('/Client/{id}/update', name: 'app_client_update')]
    #[IsGranted('ROLE_USER')]
    public function update(ManagerRegistry $doctrine, Personne $Personne, Request $request)
    {
        $form = $this->createForm(PersonneType::class, $Personne);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $doctrine->getManager();
            $entityManager->persist($Personne);
            /** @var Client $editContact */
            $editContact = $form->getData();
            $entityManager->flush();

            return $this->redirectToRoute('app_personne');
        }

        return $this->renderForm('client/update.html.twig', [
            'personne' => $Personne,
            'form' => $form,
        ]);
    }

    #[Route('/client/create', name: 'app_client_create')]
    #[IsGranted('ROLE_ADMIN')]
    public function create(ManagerRegistry $doctrineContact, Request $request, UserPasswordHasherInterface $passwordHasher)
    {
        $Personne = new Personne();
        $form = $this->createForm(PersonneTypeCreate::class, $Personne);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $Personne->setRoles(['ROLE_USER']);
            $Personne->setPassword($passwordHasher->hashPassword($Personne, $Personne->getPassword()));
            $client = new Client();
            $client->setPersonne($Personne);
            $entityManager = $doctrineContact->getManager();
            $entityManager->persist($client);
            /* @var Personne $editContact */
            $entityManager->flush();

            return $this->redirectToRoute('app_personne');
        }

        return $this->renderForm('client/create.html.twig', [
            'Personne' => $Personne,
            'form' => $form,
        ]);
    }

    #[Route('/client/{id}/delete', name: 'app_client_delete')]
    #[IsGranted('ROLE_ADMIN')]
    public function delete(Personne $Personne, Request $request, ManagerRegistry $doctrine)
    {
        $form = $this->createFormBuilder($Personne)
            ->add('Supprimer', SubmitType::class, ['label' => 'Supprimer'])
            ->add('Annuler', SubmitType::class, ['label' => 'Annuler'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($form->get('Supprimer')->isClicked()) {
                $entityManager = $doctrine->getManager();
                $entityManager->remove($Personne);
                $entityManager->flush();

                return $this->redirectToRoute('app_personne');
            }
        } else {
            return $this->render('client/delete.html.twig', [
                'Personne' => $Personne,
                'form' => $form->createView(),
            ]);
        }
    }

    #[Route('/client', name: 'app_personne')]
    public function index(Request $request, PersonneRepository $clientRepository): Response
    {
        $recherche = $request->query->get('search', '');

        $tableau = $clientRepository->search($recherche);

        return $this->render('personne/index.html.twig', ['lstContact' => $tableau, 'search' => $recherche]);
    }

    #[Route('/clientListe')]
    public function show(Personne $personne): Response
    {
        return $this->render('personne/index.html.twig', ['Personne' => $personne]);
    }
}

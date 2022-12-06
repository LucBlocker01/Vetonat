<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RacineController extends AbstractController
{
    #[Route('/', name: 'app_racine')]
    public function index(): Response
    {
        return $this->redirectToRoute('app_acceuil');
    }
}

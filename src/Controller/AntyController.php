<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AntyController extends AbstractController
{
    #[Route('/anty', name: 'app_anty')]
    public function index(): Response
    {
        return $this->render('anty/index.html.twig', [
            'controller_name' => 'AntyController',
        ]);
    }
}

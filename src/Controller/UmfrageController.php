<?php

namespace App\Controller;

use App\Repository\UmfrageRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UmfrageController extends AbstractController
{
    #[Route('/umfrage/{id}', name: 'app_umfrage')]
    public function index(int $id, UmfrageRepository $umfrageRepository): Response
    {
        return $this->render('umfrage/index.html.twig', [
            'controller_name' => 'UmfrageController',
            'umfrage' => $umfrageRepository->find($id),
        ]);
    }
}

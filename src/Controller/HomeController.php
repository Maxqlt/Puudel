<?php

namespace App\Controller;

use App\Repository\UmfrageRepository;
use App\Repository\TerminRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    // public function index(, TerminRepository $terminRepository): Response
    public function index(UmfrageRepository $umfrageRepository): Response
    {



        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'umfragen' => $umfrageRepository->findAll(),
            'testvar' => $this->getUser(),
        ]);
    }
}

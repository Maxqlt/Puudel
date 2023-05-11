<?php

namespace App\Controller;

use App\Repository\TerminRepository;
use App\Repository\UmfrageRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    // public function index(, TerminRepository $terminRepository): Response
    public function index(UmfrageRepository $umfrageRepository): Response
    {

        $testvar2 = getcwd();

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'umfragen' => $umfrageRepository->findAll(),
            'testvar' => $this->getUser(),
            'testvar2' => $testvar2,
        ]);
    }
}

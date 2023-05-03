<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IconController extends AbstractController
{
    #[Route('/icon', name: 'app_icon')]
    public function index(): Response
    {
        $css = file_get_contents('build\icomoon\style.scss');
        $matches = [];
        preg_match_all('/\.icon[a-zA-Z0-9_-]+/', $css, $matches); // Match class selectors
        $classes = array_map(function($match) {
            return substr($match, 1); // Remove leading period
        }, $matches[0]); // Extract class names from matches





        return $this->render('icon/icon.html.twig', [
            'controller_name' => 'IconController',
            'classes' => $classes,
        ]);
    }
}

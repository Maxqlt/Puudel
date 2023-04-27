<?php

namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Umfrage;
use App\Entity\Termin;
use App\Form\TerminType;
use App\Form\UserType;
use App\Form\UmfrageType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CreateController extends AbstractController
{
    public function __construct(private ManagerRegistry $doctrine) {}

    #[Route('/create', name: 'app_create')]
    public function index(Request $request): Response
    {   
        
        // create new Umfrage
        $umfrage = new Umfrage();
        
        // provide first termin
        $termin = new Termin();
        // add FIRST termin to umfrage
        $umfrage->addTermin($termin);

        // create form 
        $umfrageForm = $this->createForm(UmfrageType::class, $umfrage);
        
        // handle form
        $umfrageForm->handleRequest($request);
        if ($umfrageForm->isSubmitted() && $umfrageForm->isValid()) {
            // set expiration date
            $umfrage->setExpirationDate(new \DateTime('tomorrow'));
            $umfrage->setLoggedInUser($this->getUser());
            $umfrage->setUrlHash(uniqid());

            // create maanager and save vote
            $em = $this->doctrine->getManager();
            $em->persist($umfrage);
            $em->flush();

            // redirect to the answer page
            return $this->redirect('/umfrage/'.$umfrage->getUrlHash());
        }
        if ($umfrageForm->isSubmitted() && !$umfrageForm->isValid()) {
            $errors = $umfrageForm->getErrors(true);
            foreach ($errors as $error) {
                $this->addFlash('error', $error->getMessage());
            }
            return $this->redirectToRoute('Home');
        }

        return $this->render('create/index.html.twig', [
            'controller_name' => 'CreateController',
            'form' => $umfrageForm,
        ]);
        
    }
}

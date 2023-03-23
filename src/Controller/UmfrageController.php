<?php

namespace App\Controller;

use App\Form\UserType;
use App\Entity\User;
use App\Entity\Vote;
use App\Form\UserVoteType;
use App\Repository\UmfrageRepository;
use App\Repository\VoteRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UmfrageController extends AbstractController
{

    public function __construct(private ManagerRegistry $doctrine) {}

    #[Route('/umfrage/{id}', name: 'app_umfrage')]
    public function index(int $id, UmfrageRepository $umfrageRepository, VoteRepository $voteRepository, Request $request): Response
    {

        $umfrage = $umfrageRepository->find($id);
        $dbVotes = [];
        foreach ($umfrage->getTermins() as $termin) {
            $dbVotes[] = $voteRepository->findBy(['termin_id' => $termin->getId()]);
        }
         dd($dbVotes);

        $voter = new User();
        
        foreach ($umfrageRepository->find($id)->getTermins() as $termin) {
            $vote = new Vote();
            $vote->setUserId($voter);
            $vote->setTerminId($termin);
            $voter->addVote($vote);
        }

        // create form 
        $voterForm = $this->createForm(UserType::class, $voter);

        // handle form
        $voterForm->handleRequest($request);
        if ($voterForm->isSubmitted() && $voterForm->isValid()) {
            // set expiration date

            // create maanager and save vote
            $em = $this->doctrine->getManager();
            $em->persist($voter);
            $em->flush();
        }

        

        return $this->render('umfrage/index.html.twig', [
            'controller_name' => 'UmfrageController',
            'umfrage' => $umfrage,
            'voter' => $voterForm,
        ]);
    }
}

<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Vote;
use App\Entity\Termin;
use App\Form\UserType;
use App\Form\UserVoteType;
use App\Repository\UserRepository;
use App\Repository\VoteRepository;
use App\Repository\TerminRepository;
use App\Repository\UmfrageRepository;
use Symfony\Component\Form\FormError;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UmfrageController extends AbstractController
{

    public function __construct(private ManagerRegistry $doctrine) {}

    #[Route('/umfrage/{id}', name: 'app_umfrage')]
    public function index(
        int $id, 
        UmfrageRepository $umfrageRepository, 
        VoteRepository $voteRepository, 
        UserRepository $userRepository,
        TerminRepository $terminRepository,
        EntityManagerInterface $entityManager,
        Request $request
        ): Response
    {
        
            


        $umfrage = $umfrageRepository->find($id);
        
        $termine = $terminRepository->findBy(['umfrage_id' => $id]);
        // $votes = $voteRepository->findBy(['termin_id' => $termine]);
        // $user = $userRepository->findBy(['id' => $votes]);
        
        
        $votes = $entityManager->createQueryBuilder()
        ->select('u.name, v.answer, t.date')
        ->from(User::class, 'u')
        ->join(Termin::class, 't', 'WITH', 'v.termin_id = t.id')
        ->join(Vote::class, 'v', 'WITH', 'v.user_id = u.id AND v.termin_id = t.id' )
        ->where('v.termin_id IN (:dates)')
        ->setParameter('dates', $termine)
        ->getQuery()
        ->getResult();
        
        // dd($votes);
        $userDisplayArray = [];
        $dateSummary = [];
        foreach ($votes as $vote) {
        
            $dateSummary[$vote['date']->format('Y-m-d H:i:s')][] = $vote['answer'];
            $userDisplayArray[$vote['name']][] = [
                'date' => $vote['date']->format('Y-m-d H:i:s'),
                'answer' => $vote['answer'],
            ];
        }
        foreach ($dateSummary as $date => $answers) {
            $dateSummary[$date] = [
                'yes' => count(array_filter($answers, fn($answer) => $answer === 'yes')),
                'no' => count(array_filter($answers, fn($answer) => $answer === 'no')),
                'maybe' => count(array_filter($answers, fn($answer) => $answer === 'maybe')),
                'stared' => 0,
            ];
        }
        $maxCount = 0;
        $maxElement = '';
        foreach ($dateSummary as $key => $innerArray) {
            if (isset($innerArray['yes']) && $innerArray['yes'] > $maxCount) {
                $maxCount = $innerArray['yes'];
                $maxElement = $key;
            }
        }
        if (sizeof($dateSummary)>1){
            $dateSummary[$maxElement]['stared'] = 1;
        }
        
        

        $voter = new User();
        
        try{
            if($umfrageRepository->find($id)){

                foreach ($umfrageRepository->find($id)->getTermins() as $termin) {
                    $vote = new Vote();
                    $vote->setUserId($voter);
                    $vote->setTerminId($termin);
                    $voter->addVote($vote);
                }
            }
        }catch(\Exception $e) {

            $this->addFlash('error', 'Termin not found');
            return $this->redirect('app_home');
        }
        

        // create form 
        $voterForm = $this->createForm(UserType::class, $voter);

        // handle form
        $voterForm->handleRequest($request);
        if ($voterForm->isSubmitted() && $voterForm->isValid()) {
            try{

                $em = $this->doctrine->getManager();
                $em->persist($voter);
                $em->flush();
                
                return $this->redirect('/umfrage/'.$umfrage->getId());
            } catch(\Exception $e) {
                if ($e->getPrevious() instanceof \PDOException) {
                    $errorCode = $e->getPrevious()->errorInfo[1];
                    if ($errorCode === 1062) { // 1062 is the MySQL error code for a duplicate entry
                        $voterForm->get('name')->addError(new FormError('That name is already in use.'));
                    }
                }
                $this->addFlash('error', 'An error occurred while creating the user.');
            }
            if ($voterForm->isSubmitted() && !$voterForm->isValid()) {
                $errors = $voterForm->getErrors(true);
                foreach ($errors as $error) {
                    $this->addFlash('error', $error->getMessage());
                }
            
                // return $this->redirectToRoute('app_umfrage');
            } 
        }

        

        return $this->render('umfrage/index.html.twig', [
            'controller_name' => 'UmfrageController',
            'umfrage' => $umfrage,
            'voter' => $voterForm,
            'db_termine' => $userDisplayArray,
            'dateSummary' => $dateSummary,
        
        ]);
    }
}

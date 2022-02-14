<?php

namespace App\Controller\Admin;

use App\Entity\Code;
use App\Entity\State;
use App\Form\CodeType;
use App\Form\StateType;
use App\Repository\CodeRepository;
use App\Repository\StateRepository;
use App\Repository\VersionRepository;
use Doctrine\ORM\EntityManager; 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;


class AdminStateController extends AbstractController
{
    private $repository;
    private $em;
    public function __construct(StateRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }


    #[Route('/adminState', name: 'adminState.index')]
    public function index(): Response
    {
       $states = $this->repository->findAll();
        return $this->render('adminState/index.html.twig', compact('states'));
    }

    #[Route('/adminState/create', name: 'adminState.new')]
    public function new(Request $request): Response
    {
        $states = new State();
        $form = $this->createForm(StateType::class, $states);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
                $this -> em -> persist($states);
                $this -> em -> flush();
                return $this->redirectToRoute('adminState.index');
        }
        return $this->render('adminState/new.html.twig',  
        [
            'states' => $states,
            'form' => $form->createView()
        ]
        );
    }

    #[Route('/adminState/{id}', name: 'adminState.edit', methods:'GET|POST')]
    public function edit(State $states, Request $request): Response
    {
       $form = $this->createForm(StateType::class, $states);
       $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
                $this -> em -> flush();
                return $this->redirectToRoute('adminState.index');
        }

        return $this->render('adminState/edit.html.twig',  
        [
            'states' => $states,
            'form' => $form->createView()
        ]
        );
    }


    #[Route('/adminState/{id}', name: 'adminState.delete', methods:'DELET')]
    public function delete(State $states, Request $request):Response
    {
        if($this-> isCsrfTokenValid('delete'.$states->getId(), $request -> get('_token')))
        {
                
                $this -> em -> remove($states);
                 $this -> em -> flush();
                // throw $this->createNotFoundException("Echec de Suppression");
        }
          //  throw $this->createNotFoundException("Echec de Suppression");
        
        return $this->redirectToRoute('adminState.index');
    }
}

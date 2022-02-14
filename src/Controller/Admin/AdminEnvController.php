<?php

namespace App\Controller\Admin;

use App\Entity\Env;
use App\Form\EnvType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\EnvRepository;
use Doctrine\ORM\EntityManager; 
use Symfony\Component\HttpFoundation\Request;

use Doctrine\ORM\EntityManagerInterface;

class AdminEnvController extends AbstractController
{

    private $repository;
    private $em;
    public function __construct(EnvRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    #[Route('/adminEnv', name: 'adminEnv.index')]
    public function index(): Response
    {
        $envs = $this->repository->findAll();
        return $this->render('adminEnv/index.html.twig', compact('envs'));
        
    }
    #[Route('/adminEnv/create', name: 'adminEnv.new')]
    public function new(Request $request): Response
    {
        $envs = new Env();
        $form = $this->createForm(EnvType::class, $envs);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
                $this -> em -> persist($envs);
                $this -> em -> flush();
                return $this->redirectToRoute('adminEnv.index');
        }
        return $this->render('adminEnv/new.html.twig',  
        [
            'envs' => $envs,
            'form' => $form->createView()
        ]
        );
    }

    #[Route('/adminEnv/{id}', name: 'adminEnv.edit', methods:'GET|POST')]
    public function editEnv(Env $envs, Request $request): Response
    {
       $form = $this->createForm(EnvType::class, $envs);
       $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
                $this -> em -> flush();
                return $this->redirectToRoute('adminEnv.index');
        }

        return $this->render('adminEnv/edit.html.twig',  
        [
            'envs' => $envs,
            'form' => $form->createView()
        ]
        );
    }
    #[Route('/adminEnv/{id}', name: 'adminEnv.delete', methods:'DELET')]
    public function delete(Env $envs, Request $request):Response
    {
        if($this-> isCsrfTokenValid('delete'.$envs->getId(), $request -> get('_token')))
        {
                
                $this -> em -> remove($envs);
                 $this -> em -> flush();
               //  throw $this->createNotFoundException("Echec de Suppression");
                
        }
        // throw $this->createNotFoundException("Echec de Suppression.");
        
        return $this->redirectToRoute('adminEnv.index');
    }

}

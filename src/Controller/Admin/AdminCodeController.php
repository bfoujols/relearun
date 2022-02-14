<?php

namespace App\Controller\Admin;

use App\Entity\Code;
use App\Form\CodeType;
use App\Repository\CodeRepository;
use Doctrine\ORM\EntityManager; 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;


class AdminCodeController extends AbstractController
{
    
    private $repository;
    private $em;
    public function __construct(CodeRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }


    #[Route('/adminCode', name: 'adminCode.index')]
    public function index(): Response
    {
       $codes = $this->repository->findAll();
        return $this->render('adminCode/index.html.twig', compact('codes'));
    }

    #[Route('/adminCode/create', name: 'adminCode.new')]
    public function new(Request $request): Response
    {
        $codes = new Code();
        $form = $this->createForm(CodeType::class, $codes);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
                $this -> em -> persist($codes);
                $this -> em -> flush();
                return $this->redirectToRoute('adminCode.index');
        }
        return $this->render('adminCode/new.html.twig',  
        [
            'codes' => $codes,
            'form' => $form->createView()
        ]
        );
    }

    #[Route('/adminCode/{id}', name: 'adminCode.edit', methods:'GET|POST')]
    public function edit(Code $codes, Request $request): Response
    {
       $form = $this->createForm(CodeType::class, $codes);
       $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
                $this -> em -> flush();
                return $this->redirectToRoute('adminCode.index');
        }

        return $this->render('adminCode/edit.html.twig',  
        [
            'codes' => $codes,
            'form' => $form->createView()
        ]
        );
    }
    #[Route('/adminCode/{id}', name: 'adminCode.delete', methods:'DELET')]
    public function delete(Code $codes, Request $request):Response
    {
        if($this-> isCsrfTokenValid('delete'.$codes->getId(), $request -> get('_token')))
        {       
                $this -> em -> remove($codes);
                 $this -> em -> flush();
                // throw $this->createNotFoundException("Echec de Suppression");
                
        }
           
        
        return $this->redirectToRoute('adminCode.index');
    }
}



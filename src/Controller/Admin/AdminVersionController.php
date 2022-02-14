<?php

namespace App\Controller\Admin;


use App\Entity\Version;
use App\Form\VersionType;
use App\Repository\VersionRepository;
use Doctrine\ORM\EntityManager; 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception ;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class AdminVersionController extends AbstractController
{

    private $repository;
    private $em;
    public function __construct(VersionRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }


    #[Route('/adminVersion', name: 'adminVersion.index')]
    public function index(): Response
    {
        $versions = $this->repository->findAll();
        return $this->render('adminVersion/index.html.twig', compact('versions'));
    }

    #[Route('/adminVersion/create', name: 'adminVersion.new')]
    public function new(Request $request): Response
    {
        $versions = new Version();
        $form = $this->createForm(VersionType::class, $versions);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
                $this -> em -> persist($versions);
                $this -> em -> flush();
                return $this->redirectToRoute('adminVersion.index');
        }
        return $this->render('adminVersion/new.html.twig',  
        [
            'versions' => $versions,
            'form' => $form->createView()
        ]
        );
    }
    #[Route('/adminVersion/{id}', name: 'adminVersion.edit', methods:'GET|POST')]
    public function edit(Version $versions, Request $request): Response
    {
       $form = $this->createForm(VersionType::class, $versions);
       $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
                $this -> em -> flush();
                return $this->redirectToRoute('adminVersion.index');
        }

        return $this->render('adminVersion/edit.html.twig',  
        [
            'versions' => $versions,
            'form' => $form->createView()
        ]
        );
    }
    #[Route('/adminVersion/{id}', name: 'adminVersion.delete', methods:'DELET')]
    public function delete(Version $versions, Request $request):Response
    {
        if($this-> isCsrfTokenValid('delete'.$versions->getId(), $request -> get('_token')))
        {
                
                $this -> em -> remove($versions);
                 $this -> em -> flush();
                // throw $this->createNotFoundException("Echec de Suppression");
                
        }
           // throw $this->createNotFoundException("Echec de Suppression");
        
           
        
        return $this->redirectToRoute('adminVersion.index');
        
        
    }
}

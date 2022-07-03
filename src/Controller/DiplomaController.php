<?php

namespace App\Controller;

use App\Form\DiplomaType;
use App\Entity\Diploma;
use App\Entity\User;
use App\Repository\DiplomaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DiplomaController extends AbstractController
{
    #[Route('/diploma', name: 'diploma_manage')]
    public function manage(DiplomaRepository $diplomaRepository): Response
    {
        $diplomas = $diplomaRepository->findAll();
        return $this->render('diploma/manage.html.twig', [
            'diplomas' => $diplomas,
        ]);
    }
    
    #[Route('/diploma/create', name: 'diploma_create')]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $diploma = new Diploma();
        $form = $this->createForm(DiplomaType::class, $diploma)->handleRequest($request);
        
        
        if ($form->isSubmitted() && $form->isValid()) {
            $diploma->setUser($this->getUser());
            $entityManager->persist($diploma);
            $entityManager->flush();
            
            return $this->redirectToRoute('diploma_manage', [], Response::HTTP_SEE_OTHER);
            
        }
        return $this->render('diploma/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    #[Route('diploma/update/{id}', name: 'diploma_update')]
    public function update(Diploma $diploma, Request $request, EntityManagerInterface $entityManager): Response
    {
        
        $form = $this->createForm(DiplomaType::class, $diploma)->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $diploma->setUser($this->getUser());
            $entityManager->flush();
            
            return $this->redirectToRoute('diploma_manage', [], Response::HTTP_SEE_OTHER);
            
        }
        return $this->render('diploma/update.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    
    #[Route('diploma/delete/{id}', name: 'diploma_delete')]
    public function delete(Request $request, Diploma $diploma, EntityManagerInterface $entityManager): Response
    {
        
        $entityManager->remove($diploma);
        $entityManager->flush();
        
        return $this->redirectToRoute('diploma_manage', [], Response::HTTP_SEE_OTHER);
    }
}

<?php

namespace App\Controller;

use App\Form\LanguageSpokenType;
use App\Entity\LanguageSpoken;
use App\Repository\LanguageSpokenRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LanguageSpokenController extends AbstractController

{
    #[Route('/language/spoken', name: 'languageSpoken_manage')]
    public function manage(LanguageSpokenRepository $languageSpokenRepository): Response
    {
        $languageSpokens = $languageSpokenRepository->findAll();
        return $this->render('language_spoken/manage.html.twig', [
            'languageSpokens' => $languageSpokens
        ]);
    }
    
    #[Route('/language/spoken/create', name: 'languageSpoken_create')]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $languageSpoken = new languageSpoken();
        $form = $this->createForm(LanguageSpokenType::class, $languageSpoken)->handleRequest($request);
        
        
        if ($form->isSubmitted() && $form->isValid()) {
            $languageSpoken->setUser($this->getUser());
            $entityManager->persist($languageSpoken);
            $entityManager->flush();
            
            return $this->redirectToRoute('languageSpoken_manage', [], Response::HTTP_SEE_OTHER);
            
        }
        return $this->render('language_spoken/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    
    
    
    #[Route('language/spoken/update/{id}', name: 'languageSpoken_update')]
    public function update(LanguageSpoken $languageSpoken, Request $request, EntityManagerInterface $entityManager): Response
    {
        
        $form = $this->createForm(languageSpokenType::class, $languageSpoken)->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $languageSpoken->setUser($this->getUser());
            $entityManager->flush();
            
            return $this->redirectToRoute('languageSpoken_manage', [], Response::HTTP_SEE_OTHER);
            
        }
        return $this->render('language_spoken/update.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    
    #[Route('language/spoken/delete/{id}', name: 'languageSpoken_delete')]
    public function delete(Request $request, LanguageSpoken $languageSpoken, EntityManagerInterface $entityManager): Response
    {
        
        $entityManager->remove($languageSpoken);
        $entityManager->flush();
        
        return $this->redirectToRoute('languageSpoken_manage', [], Response::HTTP_SEE_OTHER);
    }
    
    
}

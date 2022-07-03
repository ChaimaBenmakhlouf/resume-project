<?php

namespace App\Controller;

use App\Form\SkillType;
use App\Entity\Skill;
use App\Repository\SkillRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SkillController extends AbstractController
{
    #[Route('/skill', name: 'skill_manage')]
    public function manage(SkillRepository $skillRepository): Response
    {
        $skills = $skillRepository->findAll();
        return $this->render('skill/manage.html.twig', [
            'skills' => $skills,
        ]);
    }
    
    #[Route('/skill/create', name: 'skill_create')]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $skill = new Skill();
        $form = $this->createForm(SkillType::class, $skill)->handleRequest($request);
        
        
        if ($form->isSubmitted() && $form->isValid()) {
            $skill->setUser($this->getUser());
            
            $entityManager->persist($skill);
            $entityManager->flush();
            
            return $this->redirectToRoute('skill_manage', [], Response::HTTP_SEE_OTHER);
            
        }
        return $this->render('skill/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    #[Route('skill/update/{id}', name: 'skill_update')]
    public function update(Skill $skill, Request $request, EntityManagerInterface $entityManager): Response
    {
        
        $form = $this->createForm(SkillType::class, $skill)->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $skill->setUser($this->getUser());
            
            $entityManager->flush();
            
            return $this->redirectToRoute('skill_manage', [], Response::HTTP_SEE_OTHER);
            
        }
        return $this->render('skill/update.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    
    #[Route('skill/delete/{id}', name: 'skill_delete')]
    public function delete(Request $request, Skill $skill, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($skill);
        $entityManager->flush();
        
        return $this->redirectToRoute('skill_manage', [], Response::HTTP_SEE_OTHER);
    }
}

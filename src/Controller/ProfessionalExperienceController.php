<?php

namespace App\Controller;

use App\Form\ProfessionalExperienceType;
use App\Entity\ProfessionalExperience;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Repository\ProfessionalExperienceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfessionalExperienceController extends AbstractController

{
    #[Route('/api/professional/experience', name: 'api_professional/experience_collection_get')]
    public function collection(ProfessionalExperienceRepository $professionalExperienceRepository): JsonResponse
    {
        return $this->json($professionalExperienceRepository->findAll());
    }

    #[Route('/professional/experience', name: 'professionalExperience_manage')]
    public function manage(ProfessionalExperienceRepository $professionalExperienceRepository): Response
    {
        $professionalExperiences = $professionalExperienceRepository->findAll();
        return $this->render('professional_experience/manage.html.twig', [
            'professionalExperiences' => $professionalExperiences
        ]);
    }

    #[Route('/professional/experience/create', name: 'professionalExperience_create')]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $professionalExperience = new ProfessionalExperience();
        $form = $this->createForm(ProfessionalExperienceType::class, $professionalExperience)->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $professionalExperience->setUser($this->getUser());

            $entityManager->persist($professionalExperience);
            $entityManager->flush();

            return $this->redirectToRoute('professionalExperience_manage', [], Response::HTTP_SEE_OTHER);

        }
        return $this->render('professional_experience/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    
    
    #[Route('professional/experience/update/{id}', name: 'professionalExperience_update')]
    public function update(ProfessionalExperience $professionalExperience, Request $request, EntityManagerInterface $entityManager): Response
    {
       
        $form = $this->createForm(ProfessionalExperienceType::class, $professionalExperience)->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $professionalExperience->setUser($this->getUser());

            $entityManager->flush();

            return $this->redirectToRoute('professionalExperience_manage', [], Response::HTTP_SEE_OTHER);

        }
        return $this->render('professional_experience/update.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    
    #[Route('professional/experience/delete/{id}', name: 'professionalExperience_delete')]
    public function delete(Request $request, ProfessionalExperience $professionalExperience, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$professionalExperience->getId(), $request->request->get('_token'))) {

        $entityManager->remove($professionalExperience);
        $entityManager->flush();
        }
        return $this->redirectToRoute('professionalExperience_manage', [], Response::HTTP_SEE_OTHER);
    }

   
}

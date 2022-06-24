<?php

namespace App\Controller;

use App\Form\InformationType;
use App\Entity\PersonalInformation;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Repository\PersonalInformationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PersonalInformationController extends AbstractController
{

    #[Route('/api/personal/informations', name: 'api_personalInformations_collection_get')]
    public function collection(PersonalInformationRepository $personalInformationRepository): JsonResponse
    {
        return $this->json($personalInformationRepository->findAll());
    }

    #[Route('/personal/informations', name: 'personalInformation_manage')]
    public function manage(PersonalInformationRepository $personalInformationRepository): Response
    {
        
        $personalInformations = $personalInformationRepository->findAll();
        return $this->render('personal_information/manage.html.twig', [
            'personalInformations' => $personalInformations,
        ]);
    }

    #[Route('/personal/information/create', name: 'personalInformation_create')]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $personalInformation = new PersonalInformation();
        $form = $this->createForm(InformationType::class, $personalInformation)->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $personalInformation->setUser($this->getUser());

            $entityManager->persist($personalInformation);
            $entityManager->flush();

            return $this->redirectToRoute('personalInformation_manage', [], Response::HTTP_SEE_OTHER);

        }
        return $this->render('personal_information/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    
    
    #[Route('personal/information/update/{id}', name: 'personalInformation_update')]
    public function update(PersonalInformation $personalInformation, Request $request, EntityManagerInterface $entityManager): Response
    {
       
        $form = $this->createForm(InformationType::class, $personalInformation)->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $personalInformation->setUser($this->getUser());

            $entityManager->flush();

            return $this->redirectToRoute('personalInformation_manage', [], Response::HTTP_SEE_OTHER);

        }
        return $this->render('personal_information/update.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    
    #[Route('personal/information/delete/{id}', name: 'personalInformation_delete')]
    public function delete(Request $request, PersonalInformation $personalInformation, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$personalInformation->getId(), $request->request->get('_token'))) {
        $entityManager->remove($personalInformation);
        $entityManager->flush();
        }
        return $this->redirectToRoute('personalInformation_manage', [], Response::HTTP_SEE_OTHER);
    }

   
}

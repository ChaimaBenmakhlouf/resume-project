<?php

namespace App\Controller;

use App\Form\HobbieType;
use App\Entity\Hobbie;
use App\Repository\HobbieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HobbieController extends AbstractController
{
    
    #[Route('/api/hobbie', name: 'api_hobbie_collection_get')]
    public function collection(HobbieRepository $hobbieRepository): JsonResponse
    {
        return $this->json($hobbieRepository->findAll());
    }
    
    #[Route('/hobbie', name: 'hobbie_manage')]
    public function manage(HobbieRepository $hobbieRepository): Response
    {
        $hobbies = $hobbieRepository->findAll();
        return $this->render('hobbie/manage.html.twig', [
            'hobbies' => $hobbies,
        ]);
    }
    
    #[Route('/hobbie/create', name: 'hobbie_create')]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $hobbie = new Hobbie();
        $form = $this->createForm(HobbieType::class, $hobbie)->handleRequest($request);
        
        
        if ($form->isSubmitted() && $form->isValid()) {
            $hobbie->setUser($this->getUser());
            $entityManager->persist($hobbie);
            $entityManager->flush();
            
            return $this->redirectToRoute('hobbie_manage', [], Response::HTTP_SEE_OTHER);
            
        }
        return $this->render('hobbie/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    #[Route('hobbie/update/{id}', name: 'hobbie_update')]
    public function update(Hobbie $hobbie, Request $request, EntityManagerInterface $entityManager): Response
    {
        
        $form = $this->createForm(HobbieType::class, $hobbie)->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $hobbie->setUser($this->getUser());
            
            $entityManager->flush();
            
            return $this->redirectToRoute('hobbie_manage', [], Response::HTTP_SEE_OTHER);
            
        }
        return $this->render('hobbie/update.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    
    #[Route('hobbie/delete/{id}', name: 'hobbie_delete')]
    public function delete(Hobbie $hobbie, EntityManagerInterface $entityManager): RedirectResponse
    {
        $entityManager->remove($hobbie);
        $entityManager->flush();
        
        return $this->redirectToRoute('hobbie_manage', [], Response::HTTP_SEE_OTHER);
    }
}

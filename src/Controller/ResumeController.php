<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ResumeController extends AbstractController
{
    #[Route('/resume/{id}', name: 'resume')]
    public function resume(User $user, UserRepository $userRepository): Response
    {
        $userInformation = $userRepository->findOneBy(['id'=> $user]);
        return $this->render('resume/resume.html.twig', [
            'user' => $user,
        ]);
    }
}

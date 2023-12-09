<?php

namespace App\Controller;

use App\Form\PetFormType;
use App\Service\ReviewService;
use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/profile', name: 'app_user')]
    public function index(UserService $userService, Request $request, ReviewService $reviewService): Response
    {
        $averageScore = $reviewService->getAverageScore();

        $form = $this->createForm(PetFormType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageFile = $form->get('image')->getData();
            if ($imageFile) {
                $imageName = uniqid() . '.' . $imageFile->guessExtension();

                $imageFile->move(
                    $this->getParameter('images_directory'),
                    $imageName
                );
                $data = $form->getData();
                $userService->addPet($data, $imageName);
                return $this->redirectToRoute('app_user');
            }
        }

        $user = $userService->getUser();

        return $this->render('user/index.html.twig', [
            'user' => $user,
            'form' => $form,
            'averageScore' => $averageScore
        ]);
    }
}

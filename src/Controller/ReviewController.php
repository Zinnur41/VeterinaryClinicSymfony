<?php

namespace App\Controller;

use App\Form\ReviewFormType;
use App\Service\ReviewService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReviewController extends AbstractController
{
    #[Route('/review', name: 'app_review')]
    public function index(Request $request, ReviewService $reviewService): Response
    {
        $reviews = $reviewService->getAllReviews();
        $averageScore = $reviewService->getAverageScore();

        $form = $this->createForm(ReviewFormType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $reviewService->addReview($data);
            return $this->redirectToRoute('app_review');
        }

        return $this->render('review/index.html.twig', [
            'form' => $form->createView(),
            'reviews' => $reviews,
            'averageScore' => $averageScore
        ]);
    }
}

<?php

namespace App\Controller;

use App\Form\ReviewFormType;
use App\Service\ReviewService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
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

        if ($request->isXmlHttpRequest()) { 
            if ($form->isSubmitted() && $form->isValid()) {
                $data = $form->getData();
                $reviewService->addReview($data);

                return new JsonResponse([
                    'success' => true
                ]);
            }
        }

        return $this->render('review/index.html.twig', [
            'form' => $form->createView(),
            'reviews' => $reviews,
            'averageScore' => $averageScore
        ]);
    }
}

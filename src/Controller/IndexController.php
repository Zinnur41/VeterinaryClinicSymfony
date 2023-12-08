<?php

namespace App\Controller;

use App\Service\ReviewService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    #[Route('/', name: 'app_index')]
    public function index(ReviewService $reviewService): Response
    {
        $averageScore = $reviewService->getAverageScore();
        return $this->render('index/index.html.twig', [
            'averageScore' => $averageScore
        ]);
    }
}

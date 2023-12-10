<?php

namespace App\Controller;

use App\Service\ReviewService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(ReviewService $reviewService): Response
    {
        $averageScore = $reviewService->getAverageScore();
        return $this->render('admin/index.html.twig', [
            'averageScore' => $averageScore
        ]);
    }
}

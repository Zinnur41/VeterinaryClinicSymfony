<?php

namespace App\Controller;

use App\Service\ReviewService;
use App\Service\ServicesService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ServiceController extends AbstractController
{
    #[Route('/service', name: 'app_service')]
    public function index(ServicesService $service, ReviewService $reviewService): Response
    {
        $averageScore = $reviewService->getAverageScore();

        $services = $service->getAllServices();
        return $this->render('service/services.html.twig', [
            'services' => $services,
            'averageScore' => $averageScore
        ]);
    }
}

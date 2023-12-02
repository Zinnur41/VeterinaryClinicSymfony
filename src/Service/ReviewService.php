<?php

namespace App\Service;

use App\Entity\Review;
use Doctrine\ORM\EntityManagerInterface;

class ReviewService
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getAllReviews(): array
    {
        return $this->entityManager->getRepository(Review::class)->findAll();
    }
}
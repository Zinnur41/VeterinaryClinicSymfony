<?php

namespace App\Service;

use App\Entity\Review;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;

class ReviewService
{
    private $entityManager;
    private $security;

    public function __construct(EntityManagerInterface $entityManager, Security $security)
    {
        $this->entityManager = $entityManager;
        $this->security = $security;
    }

    public function getAllReviews(): array
    {
        return $this->entityManager->getRepository(Review::class)->findAll();
    }

    public function addReview(array $fields)
    {
        $user = $this->security->getUser();
        $review = new Review();
        $review->setScore($fields['score']);
        $review->setComment($fields['comment']);
        $review->setReviewer($user);
        $this->entityManager->persist($review);
        $this->entityManager->flush();
    }

    public function getAverageScore(): float
    {
        $reviewCount = $this->entityManager->getRepository(Review::class)->getCount();
        $scoresSum = $this->entityManager->getRepository(Review::class)->findScores();
        if ($reviewCount !== 0) {
           return round($scoresSum / $reviewCount, 2);
        }
        return 0;
    }
}
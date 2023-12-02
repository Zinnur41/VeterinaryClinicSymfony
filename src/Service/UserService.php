<?php

namespace App\Service;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserService
{
    private $entityManager;
    private $passwordHasher;

    public function __construct(EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher)
    {
        $this->entityManager = $entityManager;
        $this->passwordHasher = $passwordHasher;
    }

    public function getAllUsers(): array
    {
        return $this->entityManager->getRepository(User::class)->findAll();
    }

    public function addUser(array $fields): void
    {
        $user = new User();
        $user->setEmail($fields['email']);
        $user->setFirstName($fields['firstName']);
        $user->setSecondName($fields['secondName']);
        $user->setThirdName($fields['thirdName']);
        $user->setRoles(['ROLE_USER']);
        $hashedPassword = $this->passwordHasher->hashPassword(
            $user,
            $fields['password']
        );
        $user->setPassword($hashedPassword);
        $user->setPhoneNumber($fields['phoneNumber']);
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }
}
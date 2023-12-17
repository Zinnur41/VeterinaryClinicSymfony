<?php

namespace App\Service;

use App\Entity\Examination;
use App\Entity\Pet;
use App\Entity\Services;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class UserService
{
    private $entityManager;
    private $passwordHasher;

    private $security;

    public function __construct(EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher, Security $security)
    {
        $this->entityManager = $entityManager;
        $this->passwordHasher = $passwordHasher;
        $this->security = $security;
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

    public function getUser(): UserInterface
    {
        return $this->security->getUser();
    }

    public function addPet(array $fields, $image): void
    {
        $pet = new Pet();
        $user = $this->security->getUser();

        $pet->setName($fields['name']);
        $pet->setBreed($fields['breed']);
        $pet->setAge($fields['age']);
        $pet->setGender($fields['gender']);
        $pet->setWeight($fields['weight']);
        $pet->setImage($image);
        $pet->setOwner($user);

        $this->entityManager->persist($pet);
        $this->entityManager->flush();
    }

    public function addExamination(array $fields, int $serviceId): void
    {
        $examination = new Examination();
        $service = $this->entityManager->getRepository(Services::class)->find($serviceId);
        $user = $this->security->getUser();
        $pet = $this->entityManager->getRepository(Pet::class)->find($fields['pet']);

        $examination->setService($service);
        $examination->setOwner($user);
        $examination->setPet($pet);
        $examination->setDate($fields['date']);
        $examination->setAddress($fields['address']);

        $this->entityManager->persist($examination);
        $this->entityManager->flush();
    }

    public function deleteExamination($id): void
    {
        $examination = $this->entityManager->getRepository(Examination::class)->find($id);
        $this->entityManager->remove($examination);
        $this->entityManager->flush();
    }
}
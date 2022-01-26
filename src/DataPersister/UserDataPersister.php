<?php

namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final class UserDataPersister implements ContextAwareDataPersisterInterface
{

    private $entityManager; 
    private $userPasswordHash; 

    public function __construct(EntityManagerInterface $entityManager, UserPasswordHasherInterface $userPasswordHash)
    {
        $this->entityManager = $entityManager;
        $this->userPasswordHash = $userPasswordHash; 
    }

    public function supports($data, array $context = []): bool
    {
        return $data instanceof User;
    }

    public function persist($data, array $context = [])
    {
        // call your persistence layer to save $data
        if($data->getPassword()) {
            $data->setPassword(
                $this->userPasswordHash->hashPassword($data , $data->getPassword())
            );
           
        }

        $this->entityManager->persist($data);
        $this->entityManager->flush();

        // return $data;
    }

    public function remove($data, array $context = [])
    {
        // call your persistence layer to delete $data
    }
}
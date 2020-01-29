<?php
namespace App\DataPersister;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use ApiPlatform\Core\DataPersister\DataPersisterInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserDataPersister implements DataPersisterInterface

{
    public function __construct(EntityManagerInterface $entityManager, UserPasswordEncoderInterface $userPasswordEncoder){
      $this->userPasswordEncoder=$userPasswordEncoder;
      $this->entityManager=$entityManager;  

    }
    public function supports($data):bool
    {
        return $data instanceof User;
    }
    public function persist($data)
    {
        $data->setPassword($this->userPasswordEncoder->encodePassword($data,$data->getPassword()));
        $this->entityManager->persist($data);
        $this->entityManager->flush($data);
        
    }
    public function remove($data)
    {
        
    }





}
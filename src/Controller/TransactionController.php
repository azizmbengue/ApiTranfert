<?php
// api/src/Controller/CreateBookPublication.php

namespace App\Controller;
use App\Entity\Transaction;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;




class TransactionController
{


    public function __construct(UserPasswordEncoderInterface $userPasswordEncoder, TokenStorageInterface $token)
    {
        $this->userPasswordEncoder=$userPasswordEncoder;
        $this->token=$token;
    }

    public function __invoke(Transaction $data): Transaction
    {
    }
}   
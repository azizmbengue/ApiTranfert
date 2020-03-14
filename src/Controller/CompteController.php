<?php
// api/src/Controller/CreateBookPublication.php

namespace App\Controller;

use Exception;
use App\Entity\Compte;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;




class CompteController
{


    public function __construct(UserPasswordEncoderInterface $userPasswordEncoder, TokenStorageInterface $token)
    {
        $this->userPasswordEncoder=$userPasswordEncoder;
        $this->token=$token;
    }

    public function __invoke(Compte $data): compte
    {
        //dd($data);

      //  dd($this->token->getToken()->getUser());
    $user=$data->getPartenaire()->getUsers()[0];
    $montant=$data->getDepots()[0]->getMontant();
    //$data->getSolde();
    //$montant=$data->getDepots()->getMontant()[0];
    $data->setSolde($montant);
    $pass=$user->getPassword();
    $user->setPassword($this->userPasswordEncoder->encodePassword($user,$pass));
    if($data->getDepots()[0]->getMontant()<500000) {
        throw new Exception("Montant insuffisant");
    }
        
       

        return $data;
    }
}   
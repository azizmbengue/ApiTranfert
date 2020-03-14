<?php
namespace App\Controller;

use Exception;
use App\Entity\Affectation;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;


class AffectationController
{
  
    public function __construct(UserPasswordEncoderInterface $userPasswordEncoder, TokenStorageInterface $token)
    {
        $this->userPasswordEncoder=$userPasswordEncoder;
        $this->token=$token;
    }
  
    public function __invoke(Affectation $data): Affectation
    {
 if($this->token->getToken()->getUser()->getProfile()->getLibelle()!="partenaire")
    {

        throw new Exception("Ce utilisable n'est pas affecté");
    }    
        //dd($data->getUser());
//$user=$data->getcompte()->getPartenaire()->getUsers();
       
    return $data;
        } 
        

    
}


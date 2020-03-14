<?php

namespace App\Security\Voter;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class UserVoter extends Voter
{
    protected function supports($attribute, $subject)
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, ['POST', 'GET'], 'PUT')
            && $subject instanceof User;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
        return false;
        }
        if ($user->getRoles()[0] === 'SUPER_ADMIN' && $subject->getProfile()->getLibelle() !== 'SUPER_ADMIN')
        {
        return true;
        }


        // ... (check conditions and return true to grant permission) ...
        switch ($attribute) {
            case 'POST':
        if ($user->getRoles()[0] === 'ADMIN' && 
            ($subject->getProfile()->getLibelle() === 'CAISSIER' || $subject->getProfile()->getLibelle() === 'partenaire'))
            {
        return true;
            }
        if ($user->getRoles()[0] === 'partenaire' && 
            ($subject->getProfile()->getLibelle() === 'partenaire' || $subject->getProfile()->getLibelle() === 'partenaire'))
            {
        return true;
   
    }

        if ($user->getRoles()[0] === 'partenaire' && 
            ($subject->getProfil()->getLibelle() === 'User_partenaire'))
            {
        return true;
            }
            
        break;
            case 'GET':
        if ($user->getRoles()[0] === 'ADMIN' && 
            ($subject->getProfil()->getLibelle() === 'CAISSIER' || $subject->getProfile()->getLibelle() === 'partenaire'))
            {
        return true;
            }

        if ($user->getRoles()[0] === 'partenaire' && 
            ($subject->getProfile()->getLibelle() === 'Admin_partenaire' || $subject->getProfile()->getLibelle() === 'ROLE_CAISSIER_PARTENAIRE'))
            {
        return true;
            }

        if ($user->getRoles()[0] === 'Admin_partenaire' && 
            ($subject->getProfile()->getLibelle() === 'User_partenaire'))
            {
        return true;
            }
              
        break;
            case 'PUT':
        if ($user->getRoles()[0] === 'ADMIN' && 
            ($subject->getProfile()->getLibelle() === 'CAISSIER' || $subject->getProfile()->getLibelle() === 'ROLE_PARTENAIRE'))
            {
        return true;
            }

        if ($user->getRoles()[0] === 'partenaire' && 
                ($subject->getProfil()->getLibelle() === 'partenaire' || $subject->getProfil()->getLibelle() === 'ROLE_CAISSIER_PARTENAIRE'))
            {
        return true;
            }

        if ($user->getRoles()[0] === 'Admin_partenaire' &&  
                ($subject->getProfile()->getLibelle() === 'User_partenaire'))
            {
        return true;
            }
        break;
        }
        return false;
       

}  
    }


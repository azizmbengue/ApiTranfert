<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class StatusController extends AbstractController
{
    /**
     * @Route("/api/users/status/{id}", name="status_desable", methods={"GET"})
     */
    public function status($id)
    {
        $repo = $this->getDoctrine()->getRepository(User::class);
        $user = $repo->find($id);
        $status = '';   
        if($user->getIsActive() === true)
        {
            $status= 'desactivite';
            $user->setIsActive(false);
        }
        else
        {
            $status = 'activite';
            $user->setIsActive(true);
        }
        $manager = $this->getDoctrine()->getManager();
        $manager->persist($user);
        $manager->flush();
        $data = [
            'status'=>200,
            'message'=> $user->getUsername().' est '.$status
        ];
        return $this->json($data, 200);
    }
}

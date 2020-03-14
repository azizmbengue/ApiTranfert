<?php
namespace App\DataPersister;

use App\Entity\Compte;
use App\Entity\Contrat;
use App\Repository\TermesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use ApiPlatform\Core\DataPersister\DataPersisterInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ComptePersister implements DataPersisterInterface

{
    public function __construct(EntityManagerInterface $entityManager,TermesRepository $terme){
     
        $this->entityManager=$entityManager;
        $this->terme=$terme;
    }
    public function supports($data):bool
    {
        return $data instanceof Compte;
    }
    public function persist($data)
    {
        $this->entityManager->persist($data);
        $this->entityManager->flush($data);
        $contrat=new Contrat();
        $contrat->setPartenaire($data->getPartenaire());
        $contrat->setTermes($this->terme->findAll()[0]->getTermes());

        $contrat=[

            "Numero Partenaire" => $data->getPartenaire()->getNinea(),
            "date Creation"=>$contrat->getDateCreation(),
            'termes' => $this->terme->findAll()[0]->getTermes()
        ] ;

        return new JsonResponse($contrat);
    }
    public function remove($data){}
}

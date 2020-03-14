<?php
namespace App\Controller;

use App\Entity\Depot;

class DepotController
{
    public function __invoke(Depot $data): Depot
    {
        //dd($data);
        $montant=$data->getMontant();
        
        $solde=$data->getCompte()->getSolde();
        if($montant>0)
        {
            $data->getCompte()->setSolde($montant+$solde);
return $data;
        } else{
            echo "Le montant doit etre superieur à 0";
        }
        

    }
}


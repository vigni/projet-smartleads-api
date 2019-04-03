<?php

namespace App\AdminBundle\Repository;

use App\AdminBundle\Entity\OperationSent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class OperationSentRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, OperationSent::class);
    }
    /**
     * Récupère un contact d'une opération envoyée
     */
    public function getContactOperationSent($uniqid)
    {
        return $this->createQueryBuilder('operationSent')
            ->where("operationSent.uniqIdContact = :uniqIdContact")
            ->setParameter(":uniqIdContact", $uniqid)
            ->getQuery()
            ->getScalarResult();
    }

}

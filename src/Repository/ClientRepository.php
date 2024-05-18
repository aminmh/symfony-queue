<?php

namespace App\Repository;

use App\Entity\Client;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Client>
 *
 * @method Client|null find($id, $lockMode = null, $lockVersion = null)
 * @method Client|null findOneBy(array $criteria, array $orderBy = null)
 * @method Client[]    findAll()
 * @method Client[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClientRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Client::class);
    }

    public function paginate(int $page, int $itemPerPage = 10)
    {
        return $this->createQueryBuilder('client')
            ->setFirstResult((($page - 1) * $itemPerPage))
            ->setMaxResults($itemPerPage)
            ->getQuery()
            ->getResult();
    }

    public function createExportQuery(): \Doctrine\ORM\QueryBuilder
    {
        return $this->createQueryBuilder('client');
    }
}

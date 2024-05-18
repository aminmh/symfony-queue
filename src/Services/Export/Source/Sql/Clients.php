<?php

class Clients implements \App\Contracts\ExportableSourceInterface
{

    private \Doctrine\ORM\QueryBuilder $queryBuilder;

    public function __construct(\Doctrine\ORM\QueryBuilder $query, private readonly int $from, private readonly int $to)
    {
        $this->queryBuilder = clone $query;
    }

    public function get(): array
    {
        $clients = $this->queryBuilder->setFirstResult($this->from)
            ->setMaxResults($this->to)
            ->getQuery()
            ->getResult();

        return array_map(static fn(\App\Entity\Client $client) => [
            $client->getId(),
            $client->getFirstName(),
            $client->getLastName(),
            $client->getEmail(),
            $client->getUsername(),
            $client->getPhone(),
            $client->getAddress(),
        ], $clients);
    }
}

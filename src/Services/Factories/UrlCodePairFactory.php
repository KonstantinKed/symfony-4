<?php

namespace App\Services\Factories;

use App\Entity\UrlCodePairEntity;
use App\Repository\UrlCodePairRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

class UrlCodePairFactory
{
    /**
     * @var UrlCodePairRepository
     */
    protected ObjectRepository $repository;

    public function __construct(protected EntityManagerInterface $em)
    {
        $this->repository = $this->em->getRepository(UrlCodePairEntity::class);
    }

    public function fromUrlCodePair(string $url, string $code): UrlCodePairEntity
    {
        $entity = new UrlCodePairEntity($url, $code);
        $this->em->persist($entity);
        $this->em->flush();

        return $entity;
    }

}
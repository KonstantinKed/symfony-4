<?php

namespace App\Services;

use App\Entity\UrlCodePairEntity;
use App\Repository\UrlCodePairRepository;
use Doctrine\ORM\EntityManagerInterface;

class UrlCodesService
{
    protected UrlCodePairRepository $repository;

    public function __construct(
        protected EntityManagerInterface $em
    )
    {
        $this->repository = $this->em->getRepository(UrlCodePairEntity::class);
    }

    public function getAllByUser():array
    {
        return $this->repository->findAll();
    }
}
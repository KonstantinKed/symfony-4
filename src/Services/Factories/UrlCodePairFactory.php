<?php

namespace App\Services\Factories;

use App\Entity\UrlCodePairEntity;
use App\Entity\User;
use App\Repository\UrlCodePairRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;
use InvalidArgumentException;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Security\Core\User\UserInterface;

class UrlCodePairFactory
{
    /**
     * @var UrlCodePairRepository
     */
    protected ObjectRepository $repository;

    public function __construct(
        protected EntityManagerInterface $em,
        protected Security $security
    )
    {
        $this->repository = $this->em->getRepository(UrlCodePairEntity::class);
    }

    public function fromUrlCodePair(string $url, string $code): UrlCodePairEntity
    {
        /**
         * @var User $user
        */
        $user = $this->security->getUser();
        $entity = new UrlCodePairEntity($url, $code, $user);
        $this->em->persist($entity);
        $this->em->flush();

        return $entity;
    }

    public function fromArray($data): UrlCodePairEntity
    {
        if(!isset($data['url']) || !isset($data['code'])) {
         throw new InvalidArgumentException();
        }
        $entity = new UrlCodePairEntity($data['url'], $data['code']);
        $this->em->persist($entity);
        $this->em->flush();

        return $entity;
    }

}
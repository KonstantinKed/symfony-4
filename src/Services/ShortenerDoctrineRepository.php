<?php

namespace App\Services;

use App\Entity\UrlCodePairEntity;
use App\Entity\User;
use App\Repository\UrlCodePairRepository;
use App\Services\Factories\UrlCodePairFactory;
use App\Shortener\Exceptions\DataNotFoundException;
use App\Shortener\Interfaces\ICodeSaver;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

class ShortenerDoctrineRepository implements ICodeSaver
{
    /**
     * @var UrlCodePairRepository
     */
    protected ObjectRepository $repository;

    public function __construct(protected EntityManagerInterface $em,
    protected UrlCodePairFactory $factory)
    {
        $this->repository = $this->em->getRepository(UrlCodePairEntity::class);
    }

    public function saveShortAndUrl(string $url, string $code): bool
    {
        try {
            $this->factory->fromUrlCodePair($url, $code);
            $result = true;
        } catch (\Throwable) {
            $result = false;
        }
        return $result;
    }

    public function getCodeByUrl(string $url): ?string
    {
        if (is_null($entity = $this->repository->findOneBy(['url' => $url]))) {
            throw new DataNotFoundException();
        }
        return $entity->getCode();
    }

    public function getUrlByCode(string $code): ?string
    {
        if (is_null($entity = $this->repository->findOneBy(['code' => $code]))) {
            throw new DataNotFoundException();
        }
        return $entity->getUrl();
    }
}
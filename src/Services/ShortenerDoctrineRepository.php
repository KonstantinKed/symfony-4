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
        return $this->getData(['url' => $url], "Code is not set")->getCode();
    }

    public function getUrlByCode(string $code): ?string
    {
        return $this->getData(['code' => $code], "Url was not found")->getUrl();
    }

    protected function getData(array $parametrs, string $errorMessage): UrlCodePairEntity
    {
        if (is_null($entity = $this->repository->findOneBy($parametrs))) {
            throw new DataNotFoundException($errorMessage);
        }
    }
}
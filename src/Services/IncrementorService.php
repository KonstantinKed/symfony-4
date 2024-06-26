<?php

namespace App\Services;

use App\Entity\Interfaces\IIncremental;
use Doctrine\ORM\EntityManagerInterface;
use Throwable;

class IncrementorService
{
    public function __construct(
        protected EntityManagerInterface $em
    ) {}

    public function incrementAndSave(IIncremental $object): void
    {
        $object->increment();
        try {
            $this->em->persist($object);
            $this->em->flush();
        } catch (Throwable) {
            // no need to work out further, if object is VO - it will increment only;
        }
    }
}
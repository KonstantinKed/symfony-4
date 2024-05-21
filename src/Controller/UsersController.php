<?php

namespace App\Controller;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class UsersController extends AbstractController
{
    #[Route('/', name: 'list')]
    public function list(EntityManagerInterface $em): Response
    {
        $users = $em->getRepository(User::class)->findAll();
        return $this->render('users/index.html.twig', [
            'users' => $users,
        ]);
    }
}

<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
#[Route('/users', name: 'app_users')]
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
    #[Route('/{id}', name: 'info')]
    public function info(int $id, EntityManagerInterface $em): Response
    {
        $user = $em->getRepository(User::class)->findOneBy(['id'=>$id]);

        return $this->render('users/oneUser.html.twig', [
            'user' => $user,
        ]);
    }
    #[Route('/toUpper/{str}', name: 'toUpper')]
    public function toUpper(string $str): Response
    {
        $strUpper = strtoupper($str);
        return $this->render('users/strToUpper.html.twig', [
            'str' => $str,
            'strUpper' => $strUpper,
        ]);
    }
}

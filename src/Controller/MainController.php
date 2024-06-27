<?php

namespace App\Controller;

use App\Entity\Phone;
use App\Entity\User;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function index(): Response
    {
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }
//
//    #[Route('/{id1}/{id2}', name: 'sum')]
//    public function sum(int $id1, int $id2): Response
//    {
//        $flatComm = 5;
//        $random = random_int(1, 3);
//        $baseFee = $id1 * $flatComm /100 * $id2;
//        $totalFee = $id1 * ($flatComm - $random)/100 * $id2;
//
//        return $this->render('main/bank.html.twig', [
//            'id1' => $id1,
//            'id2' => $id2,
//            'flatComm' => $flatComm,
//            'baseFee' => $baseFee,
//            'totalFee' => $totalFee,
//            'random' => $random,
//        ]);
//    }

//    #[Route('/generate_u', name: 'g_u')]
//    public function generateUsers(EntityManagerInterface $em)
//    {
//        $users = [
//            [
//                'login' => 'Ivan',
//                'pass'=> 123,
//                'phones'=> [
//                    '+380971112233',
//                    '+380971112244'
//                ]
//            ],
//            [
//                'login' => 'John',
//                'pass'=> 123,
//                'phones'=> [
//                    '+380971112255'
//                ]
//            ],
//            [
//                'login' => 'Mark',
//                'pass'=> 123,
//                'phones'=> [
//                    '+380971112266'
//                ]
//            ]
//        ];
//        foreach ($users as $user) {
//            $userA = new User($user['login'], $user['pass']);
//            $em->persist($userA);
//            foreach ($user['phones'] as $phone) {
//                $phoneA = new Phone($userA,$phone);
//                $em->persist($phoneA);
//            }
//        }
//        $em->flush();
//        return new Response('ok');
//    }
}

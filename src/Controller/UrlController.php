<?php

namespace App\Controller;


use App\Entity\UrlCodePairEntity;
use App\Services\IncrementorService;
use App\Services\UrlCodesService;
use App\Shortener\Interfaces\IUrlEncoder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
#[Route('/s', name: 'short_')]
class UrlController extends AbstractController
{
    #[Route('/encode', name: 'encode', methods: ['POST'])]
    public function encode(Request $request, IUrlEncoder $encoder): Response
    {
        $url = $request->get('url');
        $code = $encoder->encode($url);
        return $this->redirectToRoute('short_code_stat', ['code' => $code]);
    }

//    #[Route('/{code}/stats', name: 'code_stat', requirements: ['code'=>'\w{6,8}'])]
//    public function decode(UrlCodePairEntity $urlCodePair): Response
//    {
//        return $this->render('url/url_code.html.twig', [
//            'url_code' =>  $urlCodePair,
//        ]);
//    }
    #[Route('/decode/{code}', name: 'code_stat', requirements: ['code'=>'\w{6,8}'])]
    public function decode(UrlCodePairEntity $urlCodePair): Response
    {
        return $this->render('url/url_code.html.twig', [
            'url_code' =>  $urlCodePair,
        ]);
    }

    #[Route('/statistics', name: 'codes_stats')]
    public function allStats(UrlCodesService $service): Response
    {
        return $this->render('url/url_codes.html.twig', [
            'url_codes' =>  $service->getAllByUser(),
        ]);
    }

    #[Route('/{code}', name: 'redirect', requirements: ['code'=>'\w{6,8}'])]
    public function redirectUrl(UrlCodePairEntity $urlCodePair, IncrementorService $incrementorService): Response
    {
        $incrementorService->incrementAndSave($urlCodePair);
        return $this->redirect($urlCodePair->getUrl());
    }

}

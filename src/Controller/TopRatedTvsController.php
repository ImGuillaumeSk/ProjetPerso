<?php

namespace App\Controller;

use App\Service\CallApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TopRatedTvsController extends AbstractController
{
    #[Route('/top/rated/tvs', name: 'app_top_rated_tvs')]
    public function index(CallApiService $callApiService): Response
    {
        return $this->render('top_rated_tvs/index.html.twig', [
            'topTvs' => $callApiService->getTopRatedTvData()['results']
        ]);
    }
}


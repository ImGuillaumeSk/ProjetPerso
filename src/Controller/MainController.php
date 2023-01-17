<?php

namespace App\Controller;

use App\Service\CallApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(CallApiService $callApiService): Response
    {
       // var_dump($callApiService->getPopularMovieData()['results']);exit;
        return $this->render('main/index.html.twig', [
            'popMovies' => $callApiService->getPopularMovieData()['results'],
            'topMovies' => $callApiService->getTopRatedMovieData()['results'],
            'upMovies' => $callApiService->getUpcomingMovieData()['results'],
            'popTvs' => $callApiService->getPopularTvData()['results'],
            'topTvs' => $callApiService->getTopRatedTvData()['results'],
           // 'infoMovies' => $callApiService->getMovieData($movie_id),
            //'infoTvs' => $callApiService->getTvData($tv_id),

        ]);
    }
}

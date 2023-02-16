<?php

namespace App\Controller;

use App\Service\CallApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TopRatedMoviesController extends AbstractController
{
    #[Route('/top/rated/movies', name: 'app_top_rated_movies')]
    public function index(CallApiService $callApiService): Response
    {
        return $this->render('top_rated_movies/index.html.twig', [
            'topMovies' => $callApiService->getTopRatedMovieData()['results'],
        ]);
    }
}


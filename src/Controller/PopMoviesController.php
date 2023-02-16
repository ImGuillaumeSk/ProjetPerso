<?php

namespace App\Controller;

use App\Service\CallApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PopMoviesController extends AbstractController
{
    #[Route('/pop/movies', name: 'app_pop_movies')]
    public function index(CallApiService $callApiService): Response
    {
        return $this->render('pop_movies/index.html.twig', [
            'popMovies' => $callApiService->getPopularMovieData()['results'],
        ]);
    }
}
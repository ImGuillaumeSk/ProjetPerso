<?php

namespace App\Controller;

use App\Service\CallApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MovieController extends AbstractController
{
    #[Route('/movie/{movie_id}', name: 'app_movie')]
    public function index(CallApiService $callApiService, $movie_id): Response
    {
        return $this->render('movie/index.html.twig', [
            'infoMovies' => $callApiService->getMovieData($movie_id),
        ]);
    }
}

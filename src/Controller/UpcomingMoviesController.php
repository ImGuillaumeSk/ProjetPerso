<?php

namespace App\Controller;

use App\Service\CallApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UpcomingMoviesController extends AbstractController
{
    #[Route('/upcoming/movies', name: 'app_upcoming_movies')]
    public function index(CallApiService $callApiService): Response
    {
        return $this->render('upcoming_movies/index.html.twig', [
            'upMovies' => $callApiService->getUpcomingMovieData()['results'],
        ]);
    }
}
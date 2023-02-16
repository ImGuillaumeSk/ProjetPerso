<?php

namespace App\Controller;

use App\Service\CallApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PopTvsController extends AbstractController
{
    #[Route('/pop/tvs', name: 'app_pop_tvs')]
    public function index(CallApiService $callApiService): Response
    {
        return $this->render('pop_tvs/index.html.twig', [
            'popTvs' => $callApiService->getPopularTvData()['results'],
        ]);
    }
}

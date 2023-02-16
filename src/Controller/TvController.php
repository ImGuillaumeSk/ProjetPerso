<?php

namespace App\Controller;

use App\Service\CallApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TvController extends AbstractController
{
    #[Route('/tv/{tv_id}', name: 'app_tv')]
    public function index(CallApiService $callApiService, $tv_id): Response
    {
        return $this->render('tv/index.html.twig', [
            'infoTvs' => $callApiService->getTvData($tv_id)
        ]);
    }
}

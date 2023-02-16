<?php

namespace App\Controller;

use App\Repository\MediaRepository;
use App\Service\CallApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(MediaRepository $mediaRepository): Response
    {
        return $this->render('main/index.html.twig', [
            'medias' => $mediaRepository->findBy([
                'is_visible' => true
            ]),
        ]);
    }
}

<?php

namespace App\Controller;

use App\Repository\MediaRepository;
use App\Repository\NextMediaRepository;
use App\Repository\WatchedMediaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'app_profile')]
    public function index(MediaRepository $mediaRepo, NextMediaRepository $nextMediaRepo, WatchedMediaRepository $watchedMediaRepo): Response
    {
        $user = $this->getUser();
        return $this->render('profile/index.html.twig', [
            'medias' => $mediaRepo->findBy([
                // 'idUser' => $user,
            ]),
            'watchedMedias' => $watchedMediaRepo->findBy([
                // 'idUser' => $user
            ]),
            'nextMedias' => $nextMediaRepo->findBy([
                // 'idUser' => $user
            ])
        ]);
    }
}

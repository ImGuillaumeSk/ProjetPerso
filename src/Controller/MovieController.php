<?php

namespace App\Controller;

use App\Entity\Media;
use App\Entity\WatchedMedia;
use App\Repository\MediaRepository;
use App\Repository\WatchedMediaRepository;
use App\Service\CallApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MovieController extends AbstractController
{
    #[Route('/movie/{movie_id}', name: 'app_movie')]
    public function index(CallApiService $callApiService, $movie_id, MediaRepository $mediaRepository): Response
    {
        return $this->render('movie/index.html.twig', [
            'infoMovies' => $callApiService->getMovieData($movie_id),
        ]);
    }

    // #[Route('/movie/{movie_id}/watched', name: 'app_movie_watched', methods: ['GET', 'POST'])]
    // public function watchedMedia(Media $media, WatchedMediaRepository $watchedMediaRepository): Response
    // {
    //     $user = $this->getUser();
    //     $idUser = $user->id;
    //     if (!$idUser) return $this->redirectToRoute('app_login');

    //     if ($idUser->hasWatchThisMovie($id_api_movie)) {
    //         $signedUp = $watchedMediaRepository->findOneBy([
    //             'medias' => $media,
    //             'users' => $user
    //         ]);
    //         $watchedMediaRepository->remove($signedUp);
    //         $this->addFlash('Erreur', "Ce titre n'est plus dans votre liste des films visionnés.");
    //         return $this->redirectToRoute('home');
    //     }

    //     $newWatchedMedia = new WatchedMedia();
    //     $newWatchedMedia->setIdMedia($media->getId())
    //         ->setIdUser($idUser);

    //     $watchedMediaRepository->save($newWatchedMedia);
    //     $this->addFlash('Succès', "Ce titre est désormais dans votre liste des films visionnés !");

    //     return $this->redirectToRoute('home');
    // }
}

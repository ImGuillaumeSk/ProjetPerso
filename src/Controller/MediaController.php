<?php

namespace App\Controller;

use App\Entity\Media;
use App\Entity\NextMedia;
use App\Entity\WatchedMedia;
use App\Form\MediaType;
use App\Repository\MediaRepository;
use App\Repository\NextMediaRepository;
use App\Repository\WatchedMediaRepository;
use App\Service\CallApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/media')]
class MediaController extends AbstractController
{
    #[Route('/', name: 'app_media_index', methods: ['GET'])]
    public function index(MediaRepository $mediaRepository): Response
    {
        return $this->render('media/index.html.twig', [
            'media' => $mediaRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_media_new', methods: ['GET', 'POST'])]
    public function new(Request $request, MediaRepository $mediaRepository): Response
    {
        $auteur = $this->getUser();
        $medium = new Media();
        $form = $this->createForm(MediaType::class, $medium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $medium->setAuteur($auteur);
            $medium->setIsVisible(true);
            $mediaRepository->save($medium, true);

            return $this->redirectToRoute('app_media_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('media/new.html.twig', [
            'medium' => $medium,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_media_show', methods: ['GET'])]
    public function show(Media $medium): Response
    {
        return $this->render('media/show.html.twig', [
            'medium' => $medium,            
        ]);
    }

    #[Route('/{id}/edit', name: 'app_media_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Media $medium, MediaRepository $mediaRepository): Response
    {
        $form = $this->createForm(MediaType::class, $medium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $mediaRepository->save($medium, true);

            return $this->redirectToRoute('app_media_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('media/edit.html.twig', [
            'medium' => $medium,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_media_delete', methods: ['POST'])]
    public function delete(Request $request, Media $medium, MediaRepository $mediaRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$medium->getId(), $request->request->get('_token'))) {
            $mediaRepository->remove($medium, true);
        }

        return $this->redirectToRoute('app_media_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/{id}/watched', name: 'app_media_watched', methods: ['GET', 'POST'])]
    public function mediaWatched(Media $medium, WatchedMediaRepository $watchedMediaRepository): Response
    {
        $user = $this->getUser();
        if (!$user) return $this->redirectToRoute('app_login');

        if ($medium->isWatchedMedias($user)) {
            $signedUp = $watchedMediaRepository->findOneBy([
                'idMedia' => $medium,
                'idUser' => $user
            ]);
            $watchedMediaRepository->remove($signedUp);
            $this->addFlash('Attention', "Ce media n'est plus dans votre liste de medias visionnés.");
            return $this->redirectToRoute('home');
        }

        $newWatched = new WatchedMedia();
        $newWatched->setIdMedia($medium)
            ->setIdUser($user);

        $watchedMediaRepository->save($newWatched);
        $this->addFlash('Succès', "Ce media est désormais dans votre liste de medias visionnés.");

        return $this->redirectToRoute('home');
    }

    #[Route('/{id}/next', name: 'app_media_next', methods: ['GET', 'POST'])]
    public function mediaNext(Media $medium, NextMediaRepository $nextMediaRepository): Response
    {
        $user = $this->getUser();
        if (!$user) return $this->redirectToRoute('app_login');

        if ($medium->isNextMedias($user)) {
            $signedUp = $nextMediaRepository->findOneBy([
                'idMedia' => $medium,
                'idUser' => $user
            ]);
            $nextMediaRepository->remove($signedUp);
            $this->addFlash('Attention', "Ce media n'est plus dans votre liste de medias visionnés.");
            return $this->redirectToRoute('home');
        }

        $newNext = new NextMedia();
        $newNext->setIdMedia($medium)
            ->setIdUser($user);

        $nextMediaRepository->save($newNext);
        $this->addFlash('Succès', "Ce media est désormais dans votre liste de medias visionnés.");

        return $this->redirectToRoute('home');
    }
}

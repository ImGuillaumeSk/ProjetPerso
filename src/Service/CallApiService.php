<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class CallApiService
{
    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    private function getApi(string $var)
    {
        $response = $this->client->request(
            'GET',
            'https://api.themoviedb.org/3/' . $var
        );

        return $response->toArray();
    }

    public function getPopularMovieData(): array
    {
        return $this->getApi('movie/popular?api_key=169d5e95b36b08b3d140c10da72fd7a7&language=fr-FR&page=1');
    }

    public function getPopularTvData(): array
    {
        return $this->getApi('tv/popular?api_key=169d5e95b36b08b3d140c10da72fd7a7&language=fr-FR&page=1');
    }

    public function getTopRatedMovieData(): array
    {
        return $this->getApi('movie/top_rated?api_key=169d5e95b36b08b3d140c10da72fd7a7&language=fr-FR&page=1');
    }

    public function getTopRatedTvData(): array
    {
        return $this->getApi('tv/top_rated?api_key=169d5e95b36b08b3d140c10da72fd7a7&language=fr-FR&page=1');
    }

    public function getUpcomingMovieData(): array
    {
        return $this->getApi('movie/upcoming?api_key=169d5e95b36b08b3d140c10da72fd7a7&language=fr-FR&page=1');
    }

    public function getMovieData($movie_id): array
    {
        return $this->getApi('movie/' . $movie_id . '?api_key=169d5e95b36b08b3d140c10da72fd7a7&language=fr-FR');
    }

    public function getTvData($tv_id): array
    {
        return $this->getApi('tv/' . $tv_id . '?api_key=169d5e95b36b08b3d140c10da72fd7a7&language=fr-FR');
    }
}

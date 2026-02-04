<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class RickAndMortyApiService
{

    protected string $baseUrl;

    public function __construct()
    {
        $this->baseUrl = env('RICK_AND_MORTY_BASE_URL');
    }

    public function fetchCharacters(?string $name)
    {
        return Http::get("{$this->baseUrl}/character", [
            'name' => $name
        ])->json();
    }

    public function fetchLocation(string $url)
    {
        return Http::get($url)
            ->json();
    }

    public function fetchEpisodes(array $ids)
    {
        if (empty($ids)){
            return [];
        }

        $idsString = implode(',', $ids);

        $response = Http::get("{$this->baseUrl}/episode/{$idsString}")->json();

        if (isset($response['id'])) {
            return [$response];
        }
        return $response;
    }
}

<?php

namespace App\Services;

use App\Helpers\TranslateHelper;

class CharacterService
{
    protected  RickAndMortyApiService $apiService;

    public function __construct(RickAndMortyApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function listCharacters(?string $name)
    {
        $data = $this->apiService->fetchCharacters($name);
        $results = $data['results'] ?? [];

        return array_map(
            fn(array $character) => $this->formatCharacterData($character),
            $results
        );
    }

    private function formatCharacterData(array $character)
    {
        $originData = ['name' => 'Unknown', 'dimension' => 'Unknown'];

        if (!empty($character['origin']['url'])) {
            $location = $this->apiService->fetchLocation($character['origin']['url']);
            $originData['name'] = $location['name'] ?? 'Unknown';
            $originData['dimension'] = $location['dimension'] ?? 'Unknown';
        }

        $episodeIds = array_map(function ($url) {
            return basename($url);
        }, $character['episode']);

        $episodesData = $this->apiService->fetchEpisodes($episodeIds);
        $episodes = array_map(function ($episode) {
            return [
                'nome' => $episode['name'] ?? 'N/A',
                'air_date' => $episode['air_date'] ?? 'N/A',
            ];
        }, $episodesData ?? []);

        return [
            'nome' => $character['name'],
            'status' => TranslateHelper::translateCharacterStatus($character['status']),
            'especie' => $character['species'],
            'origem' => $originData['name'],
            'dimensao' => $originData['dimension'],
            'episodios' => $episodes,
            'imagem' => $character['image'],
        ];
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\SearchLogs;
use App\Services\CharacterService;
use Illuminate\Http\Request;

class CharacterController extends Controller
{
    private CharacterService $characterService;

    public function __construct(CharacterService $characterService)
    {
        $this->characterService = $characterService;
    }

    public function index(Request $request)
    {
        try {
            $name = $request->input('nome');

            SearchLogs::create([
                'search_term' => $name,
                'ip_address' => $request->ip(),
                'searched_at' => now(),
            ]);

            $characters = $this->characterService->listCharacters($name);

            return response()->json($characters, 200);
        }catch (\Exception $exception){
            return response()->json([
                'Erro' => 'Erro ao listar os dados: ' . $exception->getMessage()
            ], 500);
        }
    }
}

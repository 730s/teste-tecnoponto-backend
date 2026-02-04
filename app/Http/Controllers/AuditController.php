<?php

namespace App\Http\Controllers;

use App\Services\AuditService;
use Illuminate\Http\JsonResponse;
class AuditController extends Controller
{
    protected AuditService $auditService;

    public function __construct(AuditService $auditService){
        $this->auditService = $auditService;
    }

    public function index(): JsonResponse
    {
        try {
            $logs = $this->auditService->listLogs();

            return response()->json($logs, 200);

        } catch (\Exception $exception) {
            return response()->json([
                'Erro' => 'Erro ao listar os registros de auditoria: ' . $exception->getMessage()
            ], 500);
        }
    }
}

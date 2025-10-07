<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreUpdateCandidateTypeFormRequest;
use App\Services\CandidateTypeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CandidateTypeController extends CrudController
{
    public function __construct(private CandidateTypeService $service)
    {
        parent::__construct($service);
    }

    protected function beforeStore(StoreUpdateCandidateTypeFormRequest $request): JsonResponse
    {
        $request->validated();

        return $this->store($request);
    }

    protected function beforeUpdate(StoreUpdateCandidateTypeFormRequest $request, int $id): JsonResponse
    {
        $request->validated();

        return $this->update($request, $id);
    }

    public function destroy(int $id): JsonResponse
    {
        $this->service->destroy($id);

        return response()->json(['message' => 'Registro deletado com sucesso.'], 200);
    }

    public function restore(int $id): JsonResponse
    {
        $this->service->restore($id);

        return response()->json(['message' => 'Registro restaurado com sucesso.'], 200);
    }

    public function listCandidateTypes(Request $request)
    {
        $response = $this->service->applyFilter($request->all());
        return response($response, 200);
    }
}

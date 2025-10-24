<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreUpdateElectionTypeFormRequest;
use App\Services\ElectionTypeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ElectionTypeController extends CrudController
{
    public function __construct(private ElectionTypeService $service)
    {
        parent::__construct($service);
    }

    public function beforeStore(StoreUpdateElectionTypeFormRequest $request): JsonResponse
    {
        $request->validated();

        return $this->store($request);
    }

    public function beforeUpdate(StoreUpdateElectionTypeFormRequest $request, int $id): JsonResponse
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

    public function listElectionTypes(Request $request)
    {
        $response = $this->service->applyFilter($request->all());
        return response($response, 200);
    }
}

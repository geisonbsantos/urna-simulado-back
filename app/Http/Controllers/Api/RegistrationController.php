<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreUpdateRegistrationFormRequest;
use App\Services\RegistrationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RegistrationController extends CrudController
{
    public function __construct(
        private RegistrationService $service
    ) {
        parent::__construct($service);
    }

    public function beforeStore(StoreUpdateRegistrationFormRequest $request): JsonResponse
    {
        $request->validated();

        return $this->store($request);
    }

    public function beforeUpdate(StoreUpdateRegistrationFormRequest $request, string $id): JsonResponse
    {
        $request->validated();

        return $this->update($request, $id);
    }

    

    public function listRegistrations(Request $request)
    {
        $response = $this->service->applyFilter($request->all());
        return response($response, 200);
    }
}

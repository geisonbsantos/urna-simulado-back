<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreUpdateFaqFormRequest;
use App\Services\FaqService;
use Illuminate\Http\JsonResponse;

class FaqController extends CrudController
{
    public function __construct(
        private FaqService $service
    ) {
        parent::__construct($service);
    }

    public function beforeStore(StoreUpdateFaqFormRequest $request): JsonResponse
    {
        $request->validated();

        return $this->store($request);
    }

    public function beforeUpdate(StoreUpdateFaqFormRequest $request, string $id): JsonResponse
    {
        $request->validated();

        return $this->update($request, $id);
    }
}

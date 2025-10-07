<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreUpdateVoteFormRequest;
use App\Services\VoteService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VoteController extends CrudController
{
    public function __construct(
        private VoteService $service
    ) {
        parent::__construct($service);
    }

    protected function beforeStore(StoreUpdateVoteFormRequest $request): JsonResponse
    {
        $request->validated();

        return $this->store($request);
    }

    protected function beforeUpdate(StoreUpdateVoteFormRequest $request, string $id): JsonResponse
    {
        $request->validated();

        return $this->update($request, $id);
    }

    public function listVotes(Request $request)
    {
        $response = $this->service->applyFilter($request->all());
        return response($response, 200);
    }
}

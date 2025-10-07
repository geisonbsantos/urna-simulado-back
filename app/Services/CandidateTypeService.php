<?php

namespace App\Services;

use App\Http\Resources\CandidateTypeCollection;
use App\Http\Resources\CandidateTypeResource;
use App\Repositories\Core\CandidateTypeRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class CandidateTypeService
{
    public function __construct(
        private CandidateTypeRepository $repository
    ) {}

    public function getAll(): CandidateTypeCollection
    {
        return new CandidateTypeCollection($this->repository->getAll());
    }

    public function paginate(int $totalPage): LengthAwarePaginator
    {
        return $this->repository->paginate($totalPage);
    }

    public function findWhereFirst(string $column, string $value)
    {
        return $this->repository->findWhereFirst($column, $value);
    }

    public function applyFilter(array $data)
    {
        return $this->repository->applyFilter($data);
    }

    public function findById(int $id): CandidateTypeResource
    {
        return new CandidateTypeResource($this->repository->findById($id));
    }

    public function store(array $data): void
    {
        $this->repository->store($data);
    }

    public function update(array $request, int $id): void
    {
        $CandidateType = $this->findById($id);
        $this->repository->update($CandidateType, $request);
    }

    public function destroy(int $id): void
    {
        $CandidateType = $this->findById($id);
        $this->repository->destroy($CandidateType);
    }

    public function restore(int $id)
    {
        $this->repository->restore($id);
    }
}

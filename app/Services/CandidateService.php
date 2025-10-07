<?php

namespace App\Services;

use App\Http\Resources\CandidateCollection;
use App\Http\Resources\CandidateResource;
use App\Repositories\Core\CandidateRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class CandidateService
{
    public function __construct(
        private CandidateRepository $repository
    ) {}

    public function getAll(): CandidateCollection
    {
        return new CandidateCollection($this->repository->getAll());
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

    public function findById(int $id): CandidateResource
    {
        return new CandidateResource($this->repository->findById($id));
    }

    public function store(array $data): void
    {
        $this->repository->store($data);
    }

    public function update(array $request, int $id): void
    {
        $Candidate = $this->findById($id);
        $this->repository->update($Candidate, $request);
    }

    public function destroy(int $id): void
    {
        $Candidate = $this->findById($id);
        $this->repository->destroy($Candidate);
    }

    public function restore(int $id)
    {
        $this->repository->restore($id);
    }
}

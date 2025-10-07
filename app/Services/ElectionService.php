<?php

namespace App\Services;

use App\Http\Resources\ElectionCollection;
use App\Http\Resources\ElectionResource;
use App\Repositories\Core\ElectionRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class ElectionService
{
    public function __construct(
        private ElectionRepository $repository
    ) {}

    public function getAll(): ElectionCollection
    {
        return new ElectionCollection($this->repository->getAll());
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

    public function findById(int $id): ElectionResource
    {
        return new ElectionResource($this->repository->findById($id));
    }

    public function store(array $data): void
    {
        $this->repository->store($data);
    }

    public function update(array $request, int $id): void
    {
        $Election = $this->findById($id);
        $this->repository->update($Election, $request);
    }

    public function destroy(int $id): void
    {
        $Election = $this->findById($id);
        $this->repository->destroy($Election);
    }

    public function restore(int $id)
    {
        $this->repository->restore($id);
    }
}

<?php

namespace App\Services;

use App\Http\Resources\ElectionTypeCollection;
use App\Http\Resources\ElectionTypeResource;
use App\Repositories\Core\ElectionTypeRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class ElectionTypeService
{
    public function __construct(
        private ElectionTypeRepository $repository
    ) {}

    public function getAll(): ElectionTypeCollection
    {
        return new ElectionTypeCollection($this->repository->getAll());
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

    public function findById(int $id): ElectionTypeResource
    {
        return new ElectionTypeResource($this->repository->findById($id));
    }

    public function store(array $data): void
    {
        $this->repository->store($data);
    }

    public function update(array $request, int $id): void
    {
        $ElectionType = $this->findById($id);
        $this->repository->update($ElectionType, $request);
    }

    public function destroy(int $id): void
    {
        $ElectionType = $this->findById($id);
        $this->repository->destroy($ElectionType);
    }

    public function restore(int $id)
    {
        $this->repository->restore($id);
    }
}

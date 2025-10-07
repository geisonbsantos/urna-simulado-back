<?php

namespace App\Services;

use App\Http\Resources\AddressCollection;
use App\Http\Resources\AddressResource;
use App\Repositories\Core\AddressRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class AddressService
{
    public function __construct(
        private AddressRepository $repository
    ) {}

    public function getAll(): AddressCollection
    {
        return new AddressCollection($this->repository->getAll());
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

    public function findById(int $id): AddressResource
    {
        return new AddressResource($this->repository->findById($id));
    }

    public function store(array $data): void
    {
        $this->repository->store($data);
    }

    public function update(array $request, int $id): void
    {
        $Address = $this->findById($id);
        $this->repository->update($Address, $request);
    }

    public function destroy(int $id): void
    {
        $Address = $this->findById($id);
        $this->repository->destroy($Address);
    }

    public function restore(int $id)
    {
        $this->repository->restore($id);
    }
}

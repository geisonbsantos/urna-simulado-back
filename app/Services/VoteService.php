<?php

namespace App\Services;

use App\Repositories\Contracts\BaseInterface;
use App\Repositories\Core\VoteRepository;

class VoteService implements BaseInterface
{
    public function __construct(private VoteRepository $repository) {}

    public function getAll()
    {
        return $this->repository->getAll();
    }

    public function paginate(int $totalPage)
    {
        return $this->repository->paginate($totalPage);
    }

    public function findById(int $id): object
    {
        return $this->repository->findById($id);
    }

    public function applyFilter(array $data)
    {
        return $this->repository->applyFilter($data);
    }

    public function store(array $data): void
    {
        $this->repository->store($data);
    }

    public function update(array $data, int $id): void
    {
        $Vote = $this->findById($id);
        $this->repository->update($Vote, $data);
    }

    public function destroy(int $id): void
    {
        $Vote = $this->findById($id);
        $this->repository->destroy($Vote);
    }
}

<?php

namespace App\Repositories\Core;

use App\Models\Election;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ElectionRepository extends BaseRepository
{
    public function __construct(private Election $entity)
    {
        parent::__construct($entity);
    }

    public function getAll(): Collection
    {
        return $this->entity->withTrashed()->with('election_type', 'address', 'user')->get();
    }

    public function findById(int $id): object
    {
        return $this->entity->withTrashed()->findOrFail($id);
    }

    public function findWhereFirst(string $column, string $value)
    {
        return $this->entity->where($column, $value)->withTrashed()->first();
    }

    public function paginate(int $totalPage): LengthAwarePaginator
    {
        return $this->entity->orderBy('period')->with('election_type', 'address', 'user')->paginate($totalPage);
    }

    public function applyFilter(array $items)
	{
		$query = $this->entity::query()->with('election_type', 'address', 'user');
		foreach ($items as $item => $value) {
			if ($item == 'page' || $item == 'per_page') {
				continue;
			}
			if ($value) {
				if (in_array($item, ['period'])) {
					$value = mb_strtoupper($value, 'UTF-8');
					$query->where($item, 'LIKE',  "%$value%");
				} else {
					$query->whereRaw("UPPER($item) LIKE '%'||UPPER('" . $value . "')||'%'");
				}
			}
		}
		$page = ($item === "per_page") ? $value : 10;
		return $query->orderBy('period')->paginate($page);
	}
}

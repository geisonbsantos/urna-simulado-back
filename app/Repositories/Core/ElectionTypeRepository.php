<?php

namespace App\Repositories\Core;

use App\Models\ElectionType;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ElectionTypeRepository extends BaseRepository
{
    public function __construct(private ElectionType $entity)
    {
        parent::__construct($entity);
    }

    public function getAll(): Collection
    {
        return $this->entity->withTrashed()->with('elections')->get();
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
        return $this->entity->orderBy('description')->withTrashed()->with('elections')->paginate($totalPage);
    }

    public function applyFilter(array $items)
	{
		$query = $this->entity::query()->with('elections');
		foreach ($items as $item => $value) {
			if ($item == 'page' || $item == 'per_page') {
				continue;
			}
			if ($value) {
				if (in_array($item, ['description'])) {
					$value = mb_strtoupper($value, 'UTF-8');
					$query->where($item, 'LIKE',  "%$value%");
				} else {
					$query->whereRaw("UPPER($item) LIKE '%'||UPPER('" . $value . "')||'%'");
				}
			}
		}
		$page = ($item === "per_page") ? $value : 10;
		return $query->orderBy('desciption')->paginate($page);
	}
}

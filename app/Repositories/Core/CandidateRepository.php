<?php

namespace App\Repositories\Core;

use App\Models\Candidate;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class CandidateRepository extends BaseRepository
{
    public function __construct(private Candidate $entity)
    {
        parent::__construct($entity);
    }

    public function getAll(): Collection
    {
        return $this->entity->withTrashed()->with('candidate_type')->get();
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
        return $this->entity->orderBy('name')->withTrashed()->with('candidate_type')->paginate($totalPage);
    }

    public function applyFilter(array $items)
	{
		$query = $this->entity::query()->with('candidate_type');
		foreach ($items as $item => $value) {
			if ($item == 'page' || $item == 'per_page') {
				continue;
			}
			if ($value) {
				if (in_array($item, ['name'])) {
					$value = mb_strtoupper($value, 'UTF-8');
					$query->where($item, 'LIKE',  "%$value%");
				} else {
					$query->whereRaw("UPPER($item) LIKE '%'||UPPER('" . $value . "')||'%'");
				}
			}
		}
		$page = ($item === "per_page") ? $value : 10;
		return $query->orderBy('name')->paginate($page);
	}
}

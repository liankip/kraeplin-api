<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait HasQueryFilter
{
    public function scopeFilter($query, Request $request, array $searchable = [])
    {
        if ($search = $request->query('search')) {
            $query->where(function ($q) use ($searchable, $search) {
                foreach ($searchable as $column) {
                    $q->orWhere($column, 'like', "%$search%");
                }
            });
        }

        $sortColumn = $request->query('sort_column', 'id');
        $sortDirection = $request->query('sort_direction', 'asc');

        $query->orderBy($sortColumn, $sortDirection);

        return $query;
    }

    public function scopePaginateRequest($query, Request $request)
    {
        $limit = (int) $request->query('limit', 10);
        return $query->paginate($limit)->appends($request->query());
    }
}

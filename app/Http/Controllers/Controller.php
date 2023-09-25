<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests, DispatchesJobs;

    public array $includes;
    public array $sorts;
    public array $filters;
    public array $search;

    public function __construct(public Request $request)
    {
//        $this->middleware('auth:api', ['except' => ['login', 'store']]);
        $this->includes = $this->request->get('includes')
            ? explode(',', $this->request->get('includes'))
            : [];
        $this->sorts = $this->request->get('sorts') ?? [];
        $this->filters = $this->request->get('filters') ?? [];
        $this->search = $this->request->get('search') ?? [];
    }

    public function executeQuery(Builder $query): Builder
    {
        $this->applyFilters($query);
        $this->applySearch($query);

        return $query;
    }

    public function applyFilters(Builder $query): Builder
    {
        foreach ($this->filters as $filter) {
            if ($filter['operator'] === 'in') {
                $query->whereIn("plants.{$filter['field']}", $filter['value']);
            } else {
                $query->where("plants.{$filter['field']}", $filter['operator'], $filter['value']);
            }
        }

        return $query;
    }

    public function applySearch(Builder $query): Builder
    {
        $query->when($this->search, function (Builder $builder) {
            $builder->where($this->search['field'], 'like', "%{$this->search['value']}%");
        });

        return $query;
    }

    protected function respondWithToken($token): JsonResponse
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => 900
        ]);
    }

    public function refresh(): JsonResponse
    {
        return $this->respondWithToken(auth()->refresh());
    }
}

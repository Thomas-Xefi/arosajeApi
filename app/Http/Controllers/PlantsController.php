<?php

namespace App\Http\Controllers;

use App\Http\Requests\Plant\StorePlantRequest;
use App\Http\Requests\Plant\UpdatePlantRequest;
use App\Models\Plant;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class PlantsController extends Controller
{
    public function search(): JsonResponse
    {
        $query = Plant::query();

        $this->executeQuery($query);

        return response()->json(
            $query->get()->load($this->includes)
        );
    }

    public function show(Plant $plant): JsonResponse
    {
        return response()->json(
            $plant->load($this->includes)
        );
    }

    public function store(StorePlantRequest $request): JsonResponse
    {
        $plant = new Plant();

        $plant->fill($request->validated());
        $plant->save();

        return response()->json(
            $plant
        );
    }

    public function update(UpdatePlantRequest $request, Plant $plant): JsonResponse
    {
        $plant->update($request->validated());

        return response()->json(
            $plant->load($this->includes)
        );
    }
}

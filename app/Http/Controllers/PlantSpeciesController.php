<?php

namespace App\Http\Controllers;

use App\Models\PlantSpecies;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PlantSpeciesController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(
            PlantSpecies::all()
        );
    }
}

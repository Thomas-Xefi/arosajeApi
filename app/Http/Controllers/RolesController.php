<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    public function __invoke(): JsonResponse
    {
        return response()->json(
            Role::query()->whereIn('name', ['user', 'botanist'])->get()
        );
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\Tip\StoreTipRequest;
use App\Http\Requests\Tip\UpdateTipRequest;
use App\Models\Tip;
use Illuminate\Http\JsonResponse;

class TipsController extends Controller
{
    public function store(StoreTipRequest $request): JsonResponse
    {
        $tip = new Tip();

        $tip->fill($request->validated());

        return response()->json([
            'message' => 'Tip create successfully'
        ]);
    }

    public function show(Tip $comment)
    {
        //
    }

    public function update(UpdateTipRequest $request, Tip $tip): JsonResponse
    {
        $tip->update($request->validated());

        return response()->json([
            'message' => 'Tip update successfully'
        ]);
    }

    public function destroy(Tip $comment)
    {
        //
    }
}

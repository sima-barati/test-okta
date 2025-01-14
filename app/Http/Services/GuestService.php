<?php

namespace App\Http\Services;

use App\Http\Repositories\GuestRepository;
use App\Models\Guest;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class GuestService implements GuestRepository {
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $guests = Guest::orderBy('updated_at', 'desc')->get();
        return response()->json($guests);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
        ]);
        $guest = Guest::create($request->all());
        return response()->json($guest, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Guest $guest): JsonResponse
    {
        return response()->json($guest);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Guest $guest): JsonResponse
    {
        $validatedData = $request->validate([
            'first_name' => 'sometimes|required|string|max:255',
            'last_name' => 'sometimes|required|string|max:255',
        ]);

        $guest->update($validatedData);
        return response()->json($guest);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Guest $guest): JsonResponse
    {
        $guest->delete();
        return response()->json(null, 204);
    }
}

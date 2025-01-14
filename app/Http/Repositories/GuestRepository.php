<?php

namespace App\Http\Repositories;

use App\Models\Guest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

interface GuestRepository
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse;
    public function store(Request $request): JsonResponse;
    public function show(Guest $guest): JsonResponse;
    public function update(Request $request, Guest $guest): JsonResponse;
    public function destroy(Guest $guest): JsonResponse;

}

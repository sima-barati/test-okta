<?php

namespace App\Http\Controllers;

use App\Http\Services\GuestService;
use App\Models\Guest;
use Illuminate\Http\Request;

class GuestController extends Controller
{

    protected GuestService $guestService;

    public function __construct(GuestService $guestService)
    {
        $this->guestService = $guestService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->guestService->index();
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
    public function store(Request $request)
    {
        return $this->guestService->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Guest $guest)
    {
        return $this->guestService->show($guest);
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
    public function update(Request $request, Guest $guest)
    {
        return $this->guestService->update($request, $guest);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Guest $guest)
    {
        return $this->guestService->destroy($guest);
    }
}

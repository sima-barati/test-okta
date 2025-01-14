<?php

namespace App\Http\Services;

use App\Http\Repositories\ReservationRepository;
use App\Http\Requests\CreateReservationRequest;
use App\Models\Reservation;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ReservationService implements ReservationRepository
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservations = Reservation::orderBy('updated_at', 'desc')->get();
        return response()->json($reservations);
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
    public function store(CreateReservationRequest $request)
    {
        $reserve = Reservation::create($request->validated());
        return response()->json($reserve, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(Request $request, $id)
    {
        try {
            $reservation = Reservation::findOrFail($id);
            $reservation->update($request->all());
            return response()->json($reservation, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Reservation not found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            Reservation::destroy($id);
            return response()->json(['message' => 'Reservation deleted']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Reservation not found'], 404);
        }
    }
}

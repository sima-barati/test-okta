<?php

namespace App\Http\Services;

use App\Http\Repositories\RoomRepository;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class RoomService implements RoomRepository
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Room::query();
        if ($request->has('status')) {
            $query->where('status', $request->input('status'));
        }
        $rooms = $query->orderBy('room_number', 'asc')->paginate(10);
        return response()->json($rooms);
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
        try {
            $validated = $request->validate([
                'room_number' => 'required|unique:rooms,room_number|digits:6',
                'status' => 'required|in:ready,pending_cleanup,reserved',
            ]);

            $room = Room::create($validated);

            return response()->json($room, 201);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while creating the room.'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $room = Room::findOrFail($id);
            return response()->json($room, 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Room not found.'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while fetching the room details.'], 500);
        }
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
            $room = Room::findOrFail($id);

            $validated = $request->validate([
                'room_number' => 'required|unique:rooms,room_number,' . $id . '|digits:6',
                'status' => 'required|in:ready,pending_cleanup,reserved',
            ]);

            $room->update($validated);

            return response()->json($room, 200);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Room not found.'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while updating the room.'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $room = Room::findOrFail($id);
            if ($room->reservations()->exists()) {
                return response()->json(['error' => 'Room cannot be deleted because it has reservations.'], 400);
            }
            $room->delete();
            return response()->json(['message' => 'Room deleted successfully.'], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Room not found.'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while deleting the room.'], 500);
        }
    }

    public function changeStatus($id, $status)
    {
        try {
            $room = Room::findOrFail($id);
            $room->update(['status' => $status]);
            return response()->json($room);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while updating the room.'], 500);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Services\RoomService;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    protected RoomService $roomService;

    public function __construct(RoomService $roomService)
    {
        $this->roomService = $roomService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $this->roomService->index($request);
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
        return $this->roomService->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return $this->roomService->show($id);
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
        return $this->roomService($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        return $this->roomService->destroy($id);
    }

    /**
     * Room Change Status.
     */
    public function changeStatus($id, $status)
    {
        return $this->roomService->changeStatus($id, $status);
    }

}

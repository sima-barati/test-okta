<?php

namespace App\Http\Repositories;

use App\Http\Requests\CreateReservationRequest;
use Illuminate\Http\Request;

interface ReservationRepository
{
    public function index();

    public function create();

    public function store(CreateReservationRequest $request);

    public function show(string $id);

    public function edit(string $id);

    public function update(Request $request, $id);

    public function destroy($id);

}

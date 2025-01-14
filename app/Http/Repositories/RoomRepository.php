<?php

namespace App\Http\Repositories;

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

interface RoomRepository
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request);

    /**
     * @return mixed
     */
    public function create();

    /**
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request);

    /**
     * @param $id
     * @return mixed
     */
    public function show($id);

    /**
     * @param string $id
     * @return mixed
     */
    public function edit(string $id);

    /**
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function update(Request $request, $id);

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id);

    /**
     * @param $id
     * @param $status
     * @return mixed
     */
    public function changeStatus($id, $status);
}

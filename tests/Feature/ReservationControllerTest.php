<?php

namespace Tests\Feature;

use App\Models\Reservation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ReservationControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_index_returns_paginated_reservations()
    {
        Reservation::factory()->count(15)->create();

        $response = $this->getJson('/api/reservations');

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data',
            'links',
            'meta',
        ]);
        $response->assertJsonCount(10, 'data');
    }}

<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GuestControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_index_returns_a_list_of_guests()
    {
        // ایجاد ۱۰ مهمان به کمک فکتوری
        Guest::factory()->count(10)->create();

        $response = $this->getJson(route('guests.index'));

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id', 'first_name', 'last_name', 'created_at', 'updated_at'
                ]
            ]
        ]);
    }

    /**
     * Test for creating a new guest
     */
    public function test_store_creates_a_new_guest()
    {
        $data = [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
        ];

        $response = $this->postJson(route('guests.store'), $data);

        $response->assertStatus(201);
        $response->assertJsonFragment([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
        ]);
    }}

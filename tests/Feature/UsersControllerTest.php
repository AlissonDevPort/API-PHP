<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Testing\RefreshDatabase;


it('creates a service order successfully', function () {
    $user = User::factory()->create();

    $response = $this->postJson('/api/service-orders', [
        'vehiclePlate' => 'ABC1234',
        'entryDateTime' => now()->toDateTimeString(),
        'exitDateTime' => now()->addHours(2)->toDateTimeString(),
        'priceType' => 'hourly',
        'price' => 50.00,
        'userId' => $user->id,
    ]);

    $response->assertStatus(200)
        ->assertJsonStructure(['message', 'data']);

    $this->assertDatabaseHas('service_orders', [
        'vehiclePlate' => 'ABC1234',
        'userId' => $user->id,
    ]);
});

it('fails to create a service order with invalid data', function () {
    $response = $this->postJson('/api/service-orders', []); 

    $response->assertStatus(422); 
});

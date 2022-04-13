<?php

namespace Tests\Feature;

use App\Models\User;
use App\Types\PassengerTypes;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TransferTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_the_clerk_can_store_a_transfer()
    {
        $this->withoutExceptionHandling();

        $passengerTypes = (new PassengerTypes())->toArray();

        $TransferData = [
            'preferred_vehicle_id' => $this->faker->name(),
            'preferred_driver_id' => $this->faker->lastName(),
            'passengers' => [
                User::factory()->passenger()->create()->id,
                User::factory()->passenger()->create()->id,
                User::factory()->passenger()->create()->id,
            ],
            'locations' => [
                [
                    'address_id' => null,
                    'city' => $this->faker->city(),
                    'address' => $this->faker->address(),
                    'latitude' => $this->faker->latitude(),
                    'longitude' => $this->faker->longitude(),
                ],
                [
                    'address_id' => null,
                    'city' => $this->faker->city(),
                    'address' => $this->faker->address(),
                    'latitude' => $this->faker->latitude(),
                    'longitude' => $this->faker->longitude(),
                ]
            ]
        ];

        $clerk = User::factory()->clerk()->create();
        $this->be($clerk);

        $this->postJson(route('transfer.store'), $TransferData)->dump();
//            ->assertJsonFragment($TransferData);
//
//        $this->assertDatabaseHas('users',$TransferData);
    }
}

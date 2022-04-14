<?php

namespace Tests\Feature;

use App\Models\Address;
use App\Models\Transfer;
use App\Models\User;
use App\Models\Vehicle;
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
            'vehicle_id' => Vehicle::factory()->create()->id,
            'driver_id' => User::factory()->driver()->create()->id,
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

        $this->assertDatabaseHas('transfers', [
            'registrant_id' => $clerk->id,
            'vehicle_id' => $TransferData['vehicle_id'],
            'driver_id' => $TransferData['driver_id'],
        ]);

        $this->assertDatabaseHas('addresses', [
            'city' => $TransferData['locations'][0]['city'],
            'address' => $TransferData['locations'][0]['address'],
            'latitude' => $TransferData['locations'][0]['latitude'],
            'longitude' => $TransferData['locations'][0]['longitude']
        ]);

        $this->assertDatabaseHas('addresses', [
            'city' => $TransferData['locations'][1]['city'],
            'address' => $TransferData['locations'][1]['address'],
            'latitude' => $TransferData['locations'][1]['latitude'],
            'longitude' => $TransferData['locations'][1]['longitude']
        ]);

        $this->assertDatabaseHas('transfer_locations', [
            'transfer_id' => Transfer::first()->id,
            'address_id' => Address::first()->id,
            'arriving_time' => null,
            'leaving_time' => null,
            'starting_km' => null,
            'ending_km' => null
        ]);

        $this->assertDatabaseHas('transfer_locations', [
            'transfer_id' => Transfer::first()->id,
            'address_id' => Address::get()->last()->id,
            'arriving_time' => null,
            'leaving_time' => null,
            'starting_km' => null,
            'ending_km' => null
        ]);

        $transfer = Transfer::first();

        $this->assertDatabaseHas('transfer_passengers', [
            'passenger_id' => $TransferData['passengers'][0],
            'transfer_id' => $transfer->id
        ]);
        $this->assertDatabaseHas('transfer_passengers', [
            'passenger_id' => $TransferData['passengers'][1],
            'transfer_id' => $transfer->id
        ]);
        $this->assertDatabaseHas('transfer_passengers', [
            'passenger_id' => $TransferData['passengers'][2],
            'transfer_id' => $transfer->id
        ]);
    }
}

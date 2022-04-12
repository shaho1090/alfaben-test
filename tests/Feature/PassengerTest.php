<?php

namespace Tests\Feature;

use App\Models\User;
use App\Types\PassengerTypes;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PassengerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_the_clerk_can_store_a_passenger_s_data()
    {
        $this->withoutExceptionHandling();

        $passengerTypes = (new PassengerTypes())->toArray();

        $passengersData = [
            'name' => $this->faker->name(),
            'surname' => $this->faker->lastName(),
            'phone_number' => (string)rand(1000000000, 9999999999),
            'type' => $passengerTypes[array_rand($passengerTypes)],
            'email' => $this->faker->email(),
        ];

        $clerk = User::factory()->clerk()->create();
        $this->be($clerk);

        $this->postJson(route('passenger.store'),$passengersData)->dump()
            ->assertJsonFragment($passengersData);

        $this->assertDatabaseHas('users',$passengersData);
    }
}

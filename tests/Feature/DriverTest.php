<?php

namespace Tests\Feature;

use App\Models\User;
use App\Types\PassengerTypes;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DriverTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_the_clerk_can_store_the_driver_s_data()
    {
        $this->withoutExceptionHandling();

        $driverData = [
            'name' => $this->faker->name(),
            'surname' => $this->faker->lastName(),
            'phone_number' => (string)rand(1000000000, 9999999999),
            'email' => $this->faker->email(),
            'password' => $this->faker->password()
        ];

        $clerk = User::factory()->clerk()->create();
        $this->be($clerk);

        $response = $this->postJson(route('driver.store'), $driverData)->dump();

        unset($driverData['password']);
        $response->assertJsonFragment($driverData);
        $this->assertDatabaseHas('users',$driverData);
    }
}

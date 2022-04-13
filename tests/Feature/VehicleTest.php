<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class VehicleTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_the_clerk_can_store_the_vehicle_s_data()
    {
        $this->withoutExceptionHandling();

        $vehicleData = [
            'driver_id' => User::factory()->driver()->create()->id,
            'owner_id' => User::factory()->driver()->create()->id,
            'number_plate' => (string)rand(100000, 99999),
            'detail_id'=> null,
            'last_mod_date' => Carbon::now()->addYear()->toDateTimeString(),
            'is_active' => (string) 1,
        ];

        $clerk = User::factory()->clerk()->create();
        $this->be($clerk);

        $response = $this->postJson(route('vehicle.store'), $vehicleData);

        $this->assertDatabaseHas('vehicles',$vehicleData);

        $driver = User::query()->find($vehicleData['driver_id'])->toArray();

        $response->assertJsonFragment($this->unsetUnnecessaryUserFields($driver));

        $owner = User::query()->find($vehicleData['driver_id'])->toArray();

        $response->assertJsonFragment($this->unsetUnnecessaryUserFields($owner));

        unset($vehicleData['driver_id']);
        unset($vehicleData['owner_id']);

        $response->assertJsonFragment($vehicleData);
    }

    private function unsetUnnecessaryUserFields(array $user): array
    {
        unset($user['created_at']);
        unset($user['updated_at']);
        unset($user['deleted_at']);
        unset($user['email_verified_at']);

        return $user;
    }
}

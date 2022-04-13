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

        $response = $this->postJson(route('vehicle.store'), $vehicleData)->dump();

        $this->assertDatabaseHas('vehicles',$vehicleData);

        $driver = User::query()->find($vehicleData['driver_id'])->toArray();

        unset($driver['created_at']);
        unset($driver['updated_at']);
        unset($driver['deleted_at']);
        unset($driver['email_verified_at']);

        $response->assertJsonFragment($driver);

        $owner = User::query()->find($vehicleData['driver_id'])->toArray();

        unset($owner['created_at']);
        unset($owner['updated_at']);
        unset($owner['deleted_at']);
        unset($owner['email_verified_at']);

        $response->assertJsonFragment($owner);

        unset($vehicleData['driver_id']);
        unset($vehicleData['owner_id']);

        $response->assertJsonFragment($vehicleData);
    }
}

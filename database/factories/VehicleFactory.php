<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\vehicle>
 */
class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'driver_id' => User::factory()->driver()->create()->id,
            'owner_id' => User::factory()->driver()->create()->id,
            'number_plate' => Str::random(8),
            'detail_id' => null,
            'last_mod_date' => Carbon::now()->addMonths(rand(3,12))->toDateTimeString(),
            'is_active' => true,
        ];
    }

    public function inactive(): VehicleFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'is_active' => false,
            ];
        });
    }
}

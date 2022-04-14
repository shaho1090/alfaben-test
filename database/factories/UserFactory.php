<?php

namespace Database\Factories;

use App\Types\PassengerTypes;
use App\Types\UserTypes;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * @throws \ReflectionException
     */
    public function definition()
    {
        $passengerTypes = (new PassengerTypes())->toArray();

        return [
            'name' => $this->faker->name(),
            'surname' => $this->faker->lastName(),
            'phone_number' => (string)rand(1000000000,9999999999),
            'type' => $passengerTypes[array_rand($passengerTypes)],
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }

    public function passenger(): UserFactory
    {
        return $this->state(function (array $attributes) {

            $passengerTypes = (new PassengerTypes())->toArray();

            return [
                'type' => $passengerTypes[array_rand($passengerTypes)],
            ];
        });
    }

    public function clerk(): UserFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'type' => UserTypes::CLERK,
            ];
        });
    }

    public function driver(): UserFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'type' => UserTypes::DRIVER,
            ];
        });
    }
}

<?php

namespace Database\Factories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected static ?string $password;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'role_id' => Role::inRandomOrder()->first()->id ?? Role::factory()->create()->id,
        ];
    }

    public function jobSeeker(): static
    {
        return $this->state(fn (array $attributes) => [
            'role_id' => Role::where('name', 'job_seeker')->firstOrFail()->id,
        ]);
    }

    public function employer(): static
    {
        return $this->state(fn (array $attributes) => [
            'role_id' => Role::where('name', 'employer')->firstOrFail()->id,
        ]);
    }

    public function admin(): static
    {
        return $this->state(fn (array $attributes) => [
            'role_id' => Role::where('name', 'admin')->firstOrFail()->id,
        ]);
    }

    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}

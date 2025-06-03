<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Teacher>
 */
class TeacherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'full_name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => Hash::make('password'),
            'position' => $this->faker->randomElement(['Профессор', 'Доцент', 'Старший преподаватель']),
            'department' => $this->faker->randomElement(['Кафедра информатики', 'Кафедра математики', 'Кафедра физики']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Group>
 */
class GroupFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    private static $groupIndex = 1;

    public function definition(): array
    {
        $faculties = ['ИКН', 'ФИПТ', 'ИБО', 'ИПТИП', 'ИМ'];
        $year = date('y') - rand(0, 3);

        return [
            'group_name' => $faculties[array_rand($faculties)] .
                '-' .
                $year .
                str_pad(self::$groupIndex++, 2, '0', STR_PAD_LEFT),
            'course' => $this->faker->numberBetween(1, 4),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

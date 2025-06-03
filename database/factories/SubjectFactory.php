<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subject>
 */
class SubjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    private static $codeIndex = 100;
    private static $subjectNames = [
        'Математический анализ', 'Линейная алгебра', 'Дискретная математика',
        'Теория вероятностей', 'Программирование на Python', 'Базы данных',
        'Веб-разработка', 'Операционные системы', 'Компьютерные сети',
        'Искусственный интеллект', 'Машинное обучение', 'Алгоритмы и структуры данных',
        'Теория информации', 'Криптография', 'Функциональное программирование',
        'Объектно-ориентированное программирование', 'Программирование на C++',
        'Программирование на Java', 'Мобильная разработка', 'Управление проектами',
        'Тестирование ПО', 'Архитектура компьютеров', 'Компиляторы', 'Численные методы'
    ];

    public function definition(): array
    {
        return [
            'subject_name' => $this->faker->randomElement(self::$subjectNames),
            'code' => 'SUBJ-' . self::$codeIndex++,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

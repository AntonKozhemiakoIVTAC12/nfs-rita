<?php

namespace Database\Seeders;

use App\Models\LessonType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LessonTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            ['type_name' => 'лекция'],
            ['type_name' => 'практика'],
            ['type_name' => 'лабораторная'],
        ];

        foreach ($types as $type) {
            DB::table('lesson_types')->updateOrInsert(
                ['type_name' => $type['type_name']],
                $type
            );
        }
    }
}

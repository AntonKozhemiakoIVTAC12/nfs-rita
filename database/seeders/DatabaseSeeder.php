<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(LessonTypeSeeder::class);

        // Уменьшим количество создаваемых записей
        Teacher::factory(10)->create();
        Subject::factory(15)->create(); // Теперь 15 вместо 20
        Group::factory(6)->create();
        Student::factory(80)->create();

        $this->assignStudentsToGroups();
        $this->assignTeachersToSubjects();
    }

    private function assignStudentsToGroups(): void
    {
        $groups = Group::all();

        Student::all()->each(function ($student) use ($groups) {
            $student->groups()->attach(
                $groups->random(rand(1, 2))->pluck('group_id')->toArray()
            );
        });
    }

    private function assignTeachersToSubjects(): void
    {
        $subjects = Subject::all();

        Teacher::all()->each(function ($teacher) use ($subjects) {
            $teacher->subjects()->attach(
                $subjects->random(rand(3, 6))->pluck('subject_id')->toArray()
            );
        });
    }
}

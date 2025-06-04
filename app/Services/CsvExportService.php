<?php

namespace App\Services;

use App\Models\Lesson;

class CsvExportService
{
    public function exportAttendance(Lesson $lesson): array
    {
        $data = $this->prepareData($lesson);

        return $this->generateCsv($data);
    }

    private function prepareData(Lesson $lesson): array
    {
        $rows = [];

        $rows[] = [
            'Дата занятия',
            'Преподаватель',
            'Дисциплина',
            'Тип занятия',
            'Группа',
            'Студент',
            'Посещение',
            'Время отметки'
        ];

        $students = $lesson->group->students()
            ->orderBy('full_name')
            ->get();

        $attendanceRecords = $lesson->attendance()
            ->with('student')
            ->get()
            ->keyBy('student_id');

        foreach ($students as $student) {
            $attended = $attendanceRecords->has($student->student_id);
            $timestamp = $attended ? $attendanceRecords[$student->student_id]->timestamp : '';

            $rows[] = [
                $lesson->lesson_date,
                $lesson->teacher->full_name,
                $lesson->subject->subject_name,
                $lesson->lessonType->type_name,
                $lesson->group->group_name,
                $student->full_name,
                $attended ? 'Присутствовал' : 'Отсутствовал',
                $timestamp
            ];
        }

        return $rows;
    }

    private function generateCsv(array $data): array
    {
        $filename = "Посещаемость_{$data[1][2]}_{$data[1][0]}.csv";
        $output = fopen('php://temp', 'r+');

        fwrite($output, "\xEF\xBB\xBF");

        foreach ($data as $row) {
            fputcsv($output, $row, ';');
        }

        rewind($output);
        $csv = stream_get_contents($output);
        fclose($output);

        return [
            'content' => $csv,
            'filename' => $filename
        ];
    }
}

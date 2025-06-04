<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Services\CsvExportService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\StreamedResponse;

class LessonController extends Controller
{
    /**
     * Создание нового занятия
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'lesson_date' => 'required|date',
            'lesson_time' => 'required|date_format:H:i',
            'teacher_id' => 'required|exists:teachers,teacher_id',
            'subject_id' => 'required|exists:subjects,subject_id',
            'type_id' => 'required|exists:lesson_types,type_id',
            'group_id' => 'required|exists:groups,group_id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $lesson = Lesson::create($request->all());

        return response()->json([
            'message' => 'Занятие успешно создано',
            'lesson_id' => $lesson->lesson_id
        ], 201);
    }

    public function updateStatus(Request $request, $id): JsonResponse
    {
        $lesson = Lesson::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'status' => 'required|in:completed'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if ($lesson->status === 'completed') {
            return response()->json([
                'message' => 'Занятие уже завершено',
                'lesson_id' => $lesson->lesson_id
            ], 409);
        }

        $lesson->update(['status' => 'completed']);

        return response()->json([
            'message' => 'Статус занятия успешно обновлен',
            'lesson_id' => $lesson->lesson_id,
            'new_status' => 'completed'
        ]);
    }

    public function export($id): StreamedResponse
    {
        $lesson = Lesson::findOrFail($id);

        $service = new CsvExportService();
        $export = $service->exportAttendance($lesson);

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $export['filename'] . '"',
        ];

        return response()->streamDownload(
            function () use ($export) {
                echo $export['content'];
            },
            $export['filename'],
            $headers
        );
    }
}

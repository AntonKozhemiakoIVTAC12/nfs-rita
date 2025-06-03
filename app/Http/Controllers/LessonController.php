<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
}

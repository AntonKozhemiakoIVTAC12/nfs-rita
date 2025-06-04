<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Lesson;
use App\Models\Student;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AttendanceController extends Controller
{
    /**
     * Зарегистрировать посещение
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'lesson_id' => 'required|integer|exists:lessons,lesson_id',
            'nfc_id' => 'required|string|exists:students,nfc_id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $student = Student::where('nfc_id', $request->nfc_id)->first();

        if (!$student) {
            return response()->json([
                'message' => 'Студент с указанным NFC ID не найден'
            ], 404);
        }

        $lesson = Lesson::find($request->lesson_id);
        if (!$lesson) {
            return response()->json([
                'message' => 'Занятие не найдено'
            ], 404);
        }

        $existingAttendance = Attendance::where([
            'lesson_id' => $request->lesson_id,
            'student_id' => $student->student_id,
        ])->first();

        if ($existingAttendance) {
            return response()->json([
                'message' => 'Посещение уже зарегистрировано',
                'attendance_id' => $existingAttendance->attendance_id,
                'timestamp' => $existingAttendance->timestamp
            ], 409);
        }

        $attendance = Attendance::create([
            'lesson_id' => $request->lesson_id,
            'student_id' => $student->student_id,
        ]);

        return response()->json([
            'message' => 'Посещение успешно зарегистрировано',
            'attendance_id' => $attendance->attendance_id,
            'student' => [
                'student_id' => $student->student_id,
                'full_name' => $student->full_name,
            ],
            'lesson' => [
                'lesson_id' => $lesson->lesson_id,
                'lesson_date' => $lesson->lesson_date,
                'lesson_time' => $lesson->lesson_time,
                'subject' => $lesson->subject->subject_name,
            ]
        ], 201);
    }
}

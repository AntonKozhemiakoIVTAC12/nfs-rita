<?php

namespace App\Http\Controllers;

use App\Http\Resources\SubjectResource;
use App\Http\Resources\TeacherResource;
use App\Models\Teacher;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * Список преподавателей
     */
    public function index(): JsonResponse
    {
        $teachers = Teacher::select('teacher_id', 'full_name', 'position', 'department')
            ->orderBy('full_name')
            ->paginate(5);

        return response()->json($teachers);
    }

    /**
     * Дисциплины преподавателя
     */
    public function subjects($id): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $teacher = Teacher::findOrFail($id);
        $subjects = $teacher->subjects()->paginate(5);

        return SubjectResource::collection($subjects);
    }

    /**
     * Занятия преподавателя
     */
    public function lessons($id): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $teacher = Teacher::findOrFail($id);
        $subjects = $teacher->subjects()->paginate(5);

        return SubjectResource::collection($subjects);
    }
}

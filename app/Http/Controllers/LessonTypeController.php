<?php

namespace App\Http\Controllers;

use App\Models\LessonType;
use Illuminate\Http\JsonResponse;

class LessonTypeController extends Controller
{
    /**
     * Список типов занятий
     */
    public function index(): JsonResponse
    {
        $types = LessonType::select('type_id', 'type_name')
            ->get();

        return response()->json($types);
    }
}

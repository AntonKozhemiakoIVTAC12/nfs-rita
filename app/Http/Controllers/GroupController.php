<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\JsonResponse;

class GroupController extends Controller
{
    /**
     * Список групп
     */
    public function index(): JsonResponse
    {
        $groups = Group::select('group_id', 'group_name', 'course')
            ->orderBy('course')
            ->orderBy('group_name')
            ->paginate(5);

        return response()->json($groups);
    }
}

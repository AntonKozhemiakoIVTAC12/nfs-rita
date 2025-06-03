<?php

namespace App\Http\Controllers;

use App\Http\Resources\StudentResource;
use App\Models\Student;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class StudentController extends Controller
{
    public function index(): JsonResponse
    {
        $teachers = Student::select('student_id', 'full_name', 'nfc_id')
            ->orderBy('full_name')
            ->paginate(5);

        return response()->json($teachers);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'nfc_id' => 'required|string|max:255',
                'full_name' => 'required|string|max:255',
            ]);

            $student = Student::create($validated);

            return new StudentResource($student);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $student = Student::findOrFail($id);

            $validated = $request->validate([
                'nfc_id' => 'sometimes|string|max:255',
                'full_name' => 'sometimes|string|max:255',
            ]);

            $student->update($validated);

            return new StudentResource($student);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Student not found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $student = Student::findOrFail($id);
        $student->delete();

        return response()->json(['message' => 'Student deleted successfully']);
    }
}

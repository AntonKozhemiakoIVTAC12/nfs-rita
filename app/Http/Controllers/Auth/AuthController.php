<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Регистрация преподавателя
     */
    public function register(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:teachers',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'position' => 'nullable|string|max:255',
            'department' => 'nullable|string|max:255',
        ]);

        $teacher = Teacher::create([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'position' => $request->position,
            'department' => $request->department,
        ]);

        return response()->json([
            'message' => 'Преподаватель успешно зарегистрирован',
            'teacher' => $teacher,
            'token' => $teacher->createToken('teacher-token')->plainTextToken
        ], 201);
    }

    /**
     * Авторизация преподавателя
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $teacher = Teacher::where('email', $request->email)->first();

        if (!$teacher || !Hash::check($request->password, $teacher->password)) {
            throw ValidationException::withMessages([
                'email' => ['Неверные учетные данные'],
            ]);
        }

        return response()->json([
            'message' => 'Успешный вход',
            'teacher' => $teacher,
            'token' => $teacher->createToken('teacher-token')->plainTextToken
        ]);
    }

    /**
     * Выход из системы
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Успешный выход'
        ]);
    }
}

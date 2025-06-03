<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TeacherResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

    public function toArray($request)
    {
        return [
            'teacher_id' => $this->teacher_id,
            'full_name' => $this->full_name,
            'position' => $this->position,
            'department' => $this->department,
        ];
    }
}

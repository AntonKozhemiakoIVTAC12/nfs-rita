<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SubjectResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'subject_id' => $this->subject_id,
            'subject_name' => $this->subject_name,
            'code' => $this->code,
        ];
    }
}

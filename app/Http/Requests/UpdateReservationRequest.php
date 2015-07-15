<?php

namespace App\Http\Requests;

class UpdateReservationRequest extends Request
{
    public function rules()
    {
        return [
            'resource_id' => 'required|exists:resources,id',
            'user_id' => 'required|exists:users,id',
            'start_date' => 'required|date|after:yesterday',
            'end_date' => 'required|date|unique:users',
            'start_time' => 'required|date_format:H:i|after:yesterday',
            'end_time' => 'required|date_format:H:i|unique:users',
        ];
    }
}
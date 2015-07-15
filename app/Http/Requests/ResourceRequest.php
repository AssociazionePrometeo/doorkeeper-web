<?php

namespace App\Http\Requests;

class ResourceRequest extends Request
{
    public function rules()
    {
        return [
            'name' => 'required'
        ];
    }
}
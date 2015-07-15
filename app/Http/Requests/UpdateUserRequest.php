<?php

namespace App\Http\Requests;

class UpdateUserRequest extends Request
{
    public function rules()
    {
        $user = $this->route('users');

        return [
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$user->id,
            'password' => 'min:8'
        ];
    }
}
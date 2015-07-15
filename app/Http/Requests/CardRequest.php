<?php

namespace App\Http\Requests;

class CardRequest extends Request
{
    public function rules()
    {
        $card = $this->route('cards');
        $id = $card ? $card->id : '';

        return [
            'id' => 'required|unique:cards,id,'.$id,
            'user_id' => 'exists:users,id'
        ];
    }
}
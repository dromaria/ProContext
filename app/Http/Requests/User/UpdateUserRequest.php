<?php

namespace App\Http\Requests\User;


use App\Http\Requests\BaseRequest;

class UpdateUserRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'name' => ['string', 'max:255'],
            'email' => [
                'string',
                'max:255',
                'email',
                'lowercase',
            ],
            'age' => ['integer', 'numeric', 'between:1,200'],
        ];
    }
}

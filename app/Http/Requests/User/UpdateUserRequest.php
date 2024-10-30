<?php

namespace App\Http\Requests\User;


use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends BaseRequest
{
    public function rules(): array
    {
        $userId = $this->route('user');
        return [
            'name' => ['string', 'max:255'],
            'email' => [
                'string',
                'max:255',
                'email',
                'lowercase',
                Rule::unique('users')->ignore($userId)
            ],
            'age' => ['integer', 'numeric', 'between:1,200'],
        ];
    }
}

<?php

namespace App\Http\Requests\User;


use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'max:255',
                'email',
                'lowercase',
                Rule::unique('users'),
            ],
            'age' => ['required', 'integer', 'numeric', 'between:1,200'],
        ];
    }

    public function getName(){
        return $this->validated('name');
    }

    public function getEmail(){
        return $this->validated('email');
    }

    public function getAge(){
        return $this->validated('age');
    }
}

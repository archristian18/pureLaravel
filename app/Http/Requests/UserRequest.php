<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;

class UserRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required'],
            'email' => ['required'],
            'password' => ['required'],
        ];
    }

    public function getName()  
    {
        return $this->input('name', null);
    }

    public function getEmail()  
    {
        return $this->input('email', null);
    }

    public function getPass()
    {
        return $this->input('password', null);
    }
}

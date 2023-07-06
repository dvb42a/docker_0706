<?php

namespace App\Http\Requests\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class adminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:30','unique:admins'],
            'account'=>['required','string','max:30','unique:admins'],
            'email' => ['nullable','string', 'email', 'max:255', 'unique:admins'],
            'password' => ['required', 'string', 'min:6'],
            'role'=>['required'],
        ];
    }
}

<?php

namespace App\Http\Requests\Beauty;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class TagRequest extends FormRequest
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
            'bp_hashtag.*' => ['required|array|min:1'],
            'bp_hashtag.*'=> ['nullable','string', 'max:10','unique:bp_hashtag_sys,bp_hashtag'],
        ];
    }

    public function messages()
    {
        return [
            'bp_hashtag.*.unique' => ':input已經存在。' ,
        ];
    }

}

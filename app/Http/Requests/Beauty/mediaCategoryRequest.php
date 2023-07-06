<?php

namespace App\Http\Requests\Beauty;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class mediaCategoryRequest extends FormRequest
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
            'position' => ['required', 'max:25','regex:/^[a-zA-Z0-9]+$/'],
            'kmc_name' => ['required','string','max:25','unique:k_media_category'],
            'img_width' => ['nullable','integer','max:5000'],
            'img_height' => ['nullable','integer','max:5000'],
            'filelimited'=>['required','integer','max:500'],
            'resize_width' => ['nullable','integer','max:5000'],
            'resize_height' => ['nullable','integer','max:5000'],
            'type'=>['required'],
            'situation'=>['required','integer',Rule::in(['1','2','3','4','5','6'])],
        ];
    }
}

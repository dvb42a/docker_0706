<?php

namespace App\Http\Requests\Beauty;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class MediaRequest extends FormRequest
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
            'km_cname' => ['required', 'string', 'max:25','unique:k_media_sys,km_cname'],
            'km_cnt' => ['nullable','string','max:200'],
            'file'=>['required','image','mimes:jpeg,png,jpg'],
            'file_id'=>['integer'],
            'keywords'=>['required'],
        ];
        //Rule::unique('k_media_sys', 'km_cname')->ignore($this->km_cname)
    }
}

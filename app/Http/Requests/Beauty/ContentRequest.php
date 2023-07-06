<?php

namespace App\Http\Requests\Beauty;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ContentRequest extends FormRequest
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
            'post_date' => ['date'],
            'post_time' =>['date'],
            'bp_subsection_member_only'=>['integer',Rule::in(['0','1'])],
            'bp_display_rating'=>['integer'], // waiting for the develop update
            'bp_subsection_intro' =>['string','max:255'],
            'bp_subsection_title' =>['string','max:100','unique:bp_subsection'],
            'bp_subsection_cnt' => ['string','max:10000'],
        ];
    }
}

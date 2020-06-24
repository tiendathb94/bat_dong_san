<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveProjectRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'long_name' => 'required|max:255',
            'short_name' => 'max:50',
            'project_scale' => 'max:255',
            'total_area' => 'numeric',
            'category_id' => 'required|numeric|exists:categories,id',
            'price' => 'nullable|numeric',
            'price_unit' => 'nullable|numeric',
            'project_overview' => 'required',
            'investor_id' => 'numeric',
            'address' => 'array',
            'tab_contents' => 'array'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Bạn không được để trống trường :attribute'
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SavePostRequest extends FormRequest
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
            'title' => 'required|max:191|min:4',
            'content' => 'required',
            'category_id' => 'required',
            'slug' => 'required',
            'address' => 'required',
            'province_id' => 'required',
            'district_id' => 'required',
            'ward_id' => 'required',
            'image' => 'mimes:jpeg,jpg,png,gif|required|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Bạn không được để trống trường :attribute',
            'title.min' => 'Tiêu đề hợp lệ sẽ có ít nhất 10 chữ số',
            'title.max' => 'Tiêu đề hợp lệ sẽ có tối đa 14 chữ số',
        ];
    }
}

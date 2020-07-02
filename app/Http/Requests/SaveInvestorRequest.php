<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveInvestorRequest extends FormRequest
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
            'name' => 'required',
            'phone' => 'required|min:10|max:14',
            'email' => 'required|email:rfc,dns',
            'website' => 'required',
            'overview' => 'required',
            'logo' => 'mimes:jpeg,jpg,gif,png',
            'address' => 'required|array'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Bạn không được để trống trường :attribute',
            'phone.min' => 'Số điện thoại hợp lệ sẽ có ít nhất 10 chữ số',
            'phone.max' => 'Số điện thoại hợp lệ sẽ có tối đa 14 chữ số',
            'email.email' => 'Địa chỉ email không hợp lệ',
            'website.url' => 'Địa chỉ website không hợp lệ',
            'logo.mimes' => 'Ảnh logo chỉ chấp nhận ảnh định dạng jpeg,gif,png',
        ];
    }
}

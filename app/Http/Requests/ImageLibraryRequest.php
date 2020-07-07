<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImageLibraryRequest extends FormRequest
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
            'libraryable_type' => 'required',
            'libraryable_id' => 'required',
            'library_type' => 'required',
            'meta_data' => 'nullable|array',
            'files' => 'required',
        ];
    }
}

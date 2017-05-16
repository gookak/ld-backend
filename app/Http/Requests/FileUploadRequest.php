<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FileUploadRequest extends FormRequest
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
        // $rules = [
        //     'name' => 'required'
        // ];

        $images = count($this->input('images'));
        foreach(range(0, $images) as $index) {
            $rules['images.' . $index] = 'image|mimes:jpeg,bmp,png|max:2000|required';
        }
        return $rules;
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddCategoryRequest extends FormRequest
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
            'title' => 'required|min:2|max:60|unique:App\Models\Category,title',
            'desc' => 'required|min:10|max:255'
        ];
    }

    public function messages() {
        return [
            'title.required' => 'Необходимо указать название.',
            'title.min' => 'Название должно содержать не менее 2 символов.',
            'title.max' => 'Название может содержать не более 60 символов.',
            'title.unique' => 'Категория с таким названием уже есть.',

            'desc.required' => 'Необходимо указать описание.',
            'desc.min' => 'Описание должно содержать не менее 10 символов.',
            'desc.max' => 'Описание может содержать не более 255 символов.',
        ];
    }

}

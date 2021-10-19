<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'parent_id' => ['nullable', 'integer', Rule::exists('categories', 'id')->where('id', $this->parent_id)],
            'title' => 'required|min:2|max:60|unique:App\Models\Category,title',
            'alias' => 'string|unique:App\Models\Category,alias',
            'desc' => 'required|min:10|max:255'
        ];
    }

    public function messages() {
        return [
            'parent_id.integer' => 'Родительская категория указана неправильно.',
            'parent_id.exists' => 'Родительская категория не найдена.',

            'title.required' => 'Необходимо указать название.',
            'title.min' => 'Название должно содержать не менее 2 символов.',
            'title.max' => 'Название может содержать не более 60 символов.',
            'title.unique' => 'Категория с таким названием уже есть.',

            'alias.unique' => 'Алиас недоступен.',

            'desc.required' => 'Необходимо указать описание.',
            'desc.min' => 'Описание должно содержать не менее 10 символов.',
            'desc.max' => 'Описание может содержать не более 255 символов.',
        ];
    }

}

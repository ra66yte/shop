<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;

class UpdateCategoryRequest extends FormRequest
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
            'parent_id' => ['nullable', 'integer', Rule::exists('categories', 'id')->where('id', $this->parent_id), 'not_in:' . $this->id],
            'title' => 'required|min:2|max:60|unique:App\Models\Category,title,' . $this->id,
            //'title' => ['required', 'min:2', 'max:60', Rule::unique('categories', 'title')->ignore((int) $this->id)],
            'alias' => 'string|unique:App\Models\Category,alias,' . $this->id,
            'desc' => 'required|min:10|max:255'
        ];
    }

    public function messages()
    {
        return [
            'parent_id.integer' => 'Родительская категория указана неправильно.',
            'parent_id.exists' => 'Родительская категория не найдена.',
            'parent_id.not_in' => 'Категория не может породить себя.',

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

    protected function failedValidation(Validator $validator)
    {
        $response = [
            'status' => 'failure',
            'status_code' => 200,
            'message' => 'Bad Request',
            'errors' => $validator->errors(),
        ];

        throw new HttpResponseException(response()->json($response, 200));
    }


}

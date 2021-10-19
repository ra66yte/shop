<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class AddProductRequest extends FormRequest
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
            'category_id' => ['required', 'integer', Rule::exists('categories', 'id')->where('id', $this->category_id)],
            'title' => 'required|min:2|max:60|unique:App\Models\Product,title',
            'desc' => 'required|min:10|max:255',
            'alias' => 'string|unique:App\Models\Product,alias',
            'amount' => 'nullable|regex:/^\d{1,18}(\.\d{1,2})?$/',
            'images.*' => 'image|mimes:jpeg,bmp,png|max:2000',
        ];
    }

    public function messages() {
        return [
            'category_id.required' => 'Необходимо указать категорию.',
            'category_id.integer' => 'Категория указана неправильно.',
            'category_id.exists' => 'Категория не найдена.',

            'title.required' => 'Необходимо указать название.',
            'title.min' => 'Название должно содержать не менее 2 символов.',
            'title.max' => 'Название может содержать не более 60 символов.',
            'title.unique' => 'Товар с таким названием уже есть.',

            'desc.required' => 'Необходимо указать описание.',
            'desc.min' => 'Описание должно содержать не менее 10 символов.',
            'desc.max' => 'Описание может содержать не более 255 символов.',

            'alias.unique' => 'Алиас недоступен.',

            'amount.regex' => 'Стоимость указана неправильно.',

            'images.*.image' => 'Для загрузки доступны только изображения.',
            'images.*.mimes' => 'Для загрузки доступны изображения в формате jpeg, bmp и png.',
            'images.*.max' => 'Максимальный вес изображения 2 Mb.',

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

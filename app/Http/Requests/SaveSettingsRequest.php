<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveSettingsRequest extends FormRequest
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
            'last_name' => 'required|min:2|max:60',
            'first_name' => 'required|min:2|max:60',
            'middle_name' => 'nullable|min:2|max:60',

            'password' => 'nullable|min:6|max:60|confirmed',
            'password_confirmation' => 'same:password',
        ];
    }
    public function messages()
    {
        return [
            'last_name.required' => 'Поле "Фамилия" должно быть заполнено.',
            'last_name.min' => 'Поле "Фамилия" должно содержать не менее :min сиволов.',
            'last_name.max' => 'Поле "Фамилия" должно содержать не более :max сиволов.',

            'first_name.required' => 'Поле "Имя" должно быть заполнено.',
            'first_name.min' => 'Поле "Имя" должно содержать не менее :min сиволов.',
            'first_name.max' => 'Поле "Имя" должно содержать не более :max сиволов.',

            'middle_name.min' => 'Поле "Отчество" должно содержать не менее :min сиволов.',
            'middle_name.max' => 'Поле "Отчество" должно содержать не более :max сиволов.',

            'password.required' => 'Необходимо указать пароль.',
            'password.min' => 'Пароль должен содержать не менее :min символов.',
            'password.max' => 'Пароль должен содержать не более :max символов.',
            'password.confirmed' => 'Пароли не совпадают',
            'password_confirmation.same' => '',
        ];
    }

}

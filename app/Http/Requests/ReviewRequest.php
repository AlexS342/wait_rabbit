<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'username' => ['required', 'string', 'min:3', 'max:15', 'regex:/^[A-Za-z0-9]{3,15}$/'],
            'email' => ['required', 'email', 'max:50'],
            'review' => ['required', 'string', 'min:10', 'max:1000', 'not_regex:/[\<]{1}[\/]{0,1}[A-Za-z\-\_]{1,}[\>]{1}/'],
            'user_captcha' => ['required', 'regex:/^[a-z0-9]{4,6}$/']
        ];
    }

    public function messages(): array
    {
        return [
            'username.required' => 'Поле "Username" не может быть пустым',
            'username.string' => 'В поле "Username" должен быть строковый формат',
            'username.min' => '"Username" не может быть меньше 3 символов',
            'username.max' => '"Username" не может быть больше 15 символов',
            'username.regex' => 'В поле "Username" недопустимые символы. Используйте латинские буквы и цифры',

            'email.required' => 'Поле "Email" не может быть пустым',
            'email.email' => 'Email несоответствует ожидаемому формату',
            'email.max' => 'Мы не ожидали, что ваш email может быть больше 50 символов и не можем его обработать',

            'review.required' => 'Поле "review" не может быть пустым',
            'review.string' => 'Поле "review" должно быть строкой',
            'review.min' => 'Поле "review" не может содержать меньше 10 символов',
            'review.max' => 'Поле "review" не может содержать больше 1000 символов',
            'review.not_regex' => 'В поле "review" не допускаются HTML теги',

            'user_captcha.required' => 'Вы не ввели проверочный код',
            'user_captcha.regex' => 'В поле для ввода проверочного кода недопустимые символы',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class PlayerCreateRequest extends ApiRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:50',
                'min:2',
            ],
            'birthday' => [
                'required',
                'date_format:Y-m-d',
            ],

        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Ad alanı zorunludur.',
            'name.string' => 'Ad alanı metin tipinde olmalıdır.',
            'name.max' => 'Ad alanı en fazla 50 karakter içermelidir.',
            'name.min' => 'Ad alanı en az 2 karakter içermelidir.',
            'birthDate.required' => 'Doğum Tarihi alanı zorunludur.',
            'birthDate.date_format' => 'Doğum Tarihi yıl-ay-gün formatında olmalıdır (örneğin: 2023-09-02).',
        ];
    }
}

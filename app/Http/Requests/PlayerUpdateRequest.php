<?php

namespace App\Http\Requests;

class PlayerUpdateRequest extends ApiRequest
{


    public mixed $birthday;
    public mixed $name;
    public mixed $id;

    public function authorize(): bool
    {

        return true;

    }

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
            'birthDay.required' => 'Doğum Tarihi alanı zorunludur.',
            'birthDay.date_format' => 'Doğum Tarihi yıl-ay-gün formatında olmalıdır (örneğin: 2023-09-02).',
        ];
    }
}

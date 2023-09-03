<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreScoreRequest extends ApiRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules()
    {
        return [
            'score' => 'required|integer',
            'date' => 'required|date_format:Y-m-d',
            'player_id' => 'required|exists:players,id',
        ];
    }

    public function messages()
    {
        return [
            'score.required' => 'Skor alanı zorunludur.',
            'score.integer' => 'Skor alanı bir tam sayı olmalıdır.',
            'date.required' => 'Tarih alanı zorunludur.',
            'date.date_format' => 'Tarih alanı yıl-ay-gün formatında olmalıdır (örneğin: 2023-09-02).',
            'player_id.required' => 'Oyuncu ID alanı zorunludur.',
            'player_id.exists' => 'Geçerli bir oyuncu ID seçmelisiniz.',
        ];
    }
}

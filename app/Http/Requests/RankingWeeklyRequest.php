<?php

namespace App\Http\Requests;

class RankingWeeklyRequest extends ApiRequest
{
    public function authorize(): bool
    {

        return true;

    }

    public function rules(): array
    {
        return [
            'endDate' => [
                'required',
                'date_format:Y-m-d',
            ],
            'startDate' => [
                'required',
                'date_format:Y-m-d',
            ],


        ];
    }
}

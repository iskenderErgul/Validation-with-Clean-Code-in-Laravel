<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

class ApiRequest extends FormRequest
{


    protected function failedValidation(Validator $validator)
    {
        $validationException = new ValidationException($validator);

        $response = [];
        $response['result'] = "Validasyon Başarısız!";
        $response['message'] = "Hatalar gerçekleşti";
        $response['errors'] = $validationException->errors();

        throw (new HttpResponseException(response()->json($response, 422)));
    }

    protected  function failedAuthorization()
    {
        $response = [];
        $response['result'] = "Yetkilendirme Başarısız";
        $response['message'] = "Bu işlemi yapmaya yetkiniz yok";
        throw (new HttpResponseException(response()->json($response, 422)));
    }
}

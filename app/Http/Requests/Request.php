<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class Request extends FormRequest
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
            //
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        if (!$this->ajax() && !$this->wantsJson()) {
            parent::failedValidation($validator);
        }

        $errors = $validator->errors()->getMessages();

        $error = array_first($errors, function () {
            return true;
        });

        $error = array_first($error, function () {
            return true;
        });

        $error = [
            'code'    => 'validation',
            'title'   => trans('errors.common.error'),
            'message' => $error,
        ];

        $response = response()->json($error, 400);

        throw new HttpResponseException($response);
    }
}

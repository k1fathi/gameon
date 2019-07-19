<?php

namespace App\Http\Requests\Api;


class LoginRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email'      => 'required|email|exists:users,email',
            'password'   => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'email'      => trans('models.user.email'),
            'password'   => trans('models.user.password'),
        ];
    }
}

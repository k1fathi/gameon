<?php

namespace App\Http\Requests\Api;


class PasswordRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'new_password' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'new_password' => trans('models.user.new_password'),
        ];
    }
}

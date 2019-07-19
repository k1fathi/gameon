<?php

namespace App\Http\Requests\Web;


class ResetRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'password' => 'required|between:6,255|confirmed',
        ];
    }

    public function attributes()
    {
        return [
            'password' => trans('models.user.password'),
        ];
    }
}

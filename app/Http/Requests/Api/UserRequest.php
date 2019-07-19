<?php

namespace App\Http\Requests\Api;


class UserRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->user()->id;
        return [
            'email'    => 'required|email|unique:users,email,' . $id,
            'password' => '',
            'name'     => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'email'    => trans('models.user.email'),
            'name'     => trans('models.user.name'),
            'password' => trans('models.user.password'),
        ];
    }
}

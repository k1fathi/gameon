<?php

namespace App\Http\Requests\Api;


class UserUpdateRequest extends Request
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
            'email' => 'email|unique:users,email,' . $id,
        ];
    }

    public function attributes()
    {
        return [
            'email'    => trans('models.user.email'),
        ];
    }
}

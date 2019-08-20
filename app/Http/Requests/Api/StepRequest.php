<?php

namespace App\Http\Requests\Api;

class StepRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=> 'required|max:100',
            'description'=> 'required|max:255',
        ];
    }
}

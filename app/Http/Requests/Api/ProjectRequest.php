<?php

namespace App\Http\Requests\Api;

class ProjectRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     * @return array
     */
    public function rules()
    {
        return [
            'name'=> 'required|max:255',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
        ];
    }

    public function attributes()
    {
        return [
            'name' => trans('models.project.name'),
        ];
    }
}

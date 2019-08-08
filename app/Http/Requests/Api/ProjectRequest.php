<?php

namespace App\Http\Requests\Api;


use Illuminate\Support\Facades\App;

class ProjectRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     * @return array
     */
    public function rules()
    {
        return [
            'name:' . App::getLocale() => 'bail|required|unique:|max:255',
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

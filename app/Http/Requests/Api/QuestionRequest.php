<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\Request;
use App\Models\Language;

class QuestionRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $locales = Language::requiredLocales();

        $rules = [
            'type' => 'required',
        ];

        foreach ($locales as $locale) {
            $rules['title:' . $locale] = 'required';
        }

        return $rules;
    }

    public function attributes()
    {
        $attributes = [
            'type'  => trans('models.question.type'),
        ];


        $locales = Language::locales();

        foreach ($locales as $locale) {
            $attributes['title:' . $locale] = trans('models.question.title') . ' ' . '(' . $locale . ')';
        }

        return $attributes;
    }
}

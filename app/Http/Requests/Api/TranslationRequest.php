<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\Request;
use App\Models\Language;

class TranslationRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        foreach (Language::requiredLocales() as $locale) {
           $rules['value:' . $locale] = 'required';
        }
        return $rules;
    }

    public function attributes()
    {
        $attributes = [
        ];

        foreach (Language::locales() as $locale) {
            $attributes['value:' . $locale] = trans('models.translation.value') . ' ' . '(' . $locale . ')';
        }
        return $attributes;
    }
}

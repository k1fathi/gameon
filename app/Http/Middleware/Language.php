<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;

class Language
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // TODO: "tr-TR,tr;q=0.8,en-US;q=0.6,en;q=0.4"
        $language = $request->header('Accept-Language');

        view()->share('locales', \App\Models\Language::locales());

        $this->setLanguage($language, $request);

        return $next($request);
    }

    public function setLanguage($language, $request)
    {
        $language = substr($language, 0, 2);
        $locales = Language::locales();

        $currentLocale = 'en';
        foreach ($locales as $locale) {
            if (starts_with($language, $locale)) {
                $currentLocale = $locale;
                break;
            }
        }

        app()->setLocale($currentLocale);
        Carbon::setLocale($currentLocale);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Language;

class Locale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $app_locales = Language::getLocales();

        $default = Language::getDefault();
        $current = session()->get('locale');
        
        $locale = in_array($current, $app_locales) ? $current : $default;

        \App::setLocale($locale);
        return $next($request);
    }
}

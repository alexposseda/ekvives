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
        if($request->route()->getPrefix() == '/admin' AND session()->get('override_locale')){
            $current = session()->get('override_locale');
        }else{
            $app_locales = Language::getLocales();

            $uri         = $request->path();
            $segmentsURI = explode('/', $uri);
            if(!empty($segmentsURI[0]) && in_array($segmentsURI[0], $app_locales)){
                $current = array_shift($segmentsURI);
            }else{
                $current = Language::getDefault();
            }

        }

        \App::setLocale($current);
        return $next($request);
    }
}

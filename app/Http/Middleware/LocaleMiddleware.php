<?php

namespace App\Http\Middleware;

use App\Models\Category;
use App\Setting;
use Closure;
use App;
use Request;
use Session;
use App\Models\Lang;

class LocaleMiddleware
{
    public static $mainLanguage = 'en'; //основной язык, который не должен отображаться в URl

    public static $languages = []; // Указываем, какие языки будем использовать в приложении.

    public function __construct()
    {
        self::$languages = Lang::pluck('code')->toArray();
    }

    /*
     * Проверяет наличие корректной метки языка в текущем URL
     * Возвращает метку или значеие null, если нет метки
     */
    public static function getLocale()
    {
        $uri = Request::path(); //получаем URI

        $segmentsURI = explode('/', $uri); //делим на части по разделителю "/"

        //Проверяем метку языка  - есть ли она среди доступных языков
        if (!empty($segmentsURI[0]) && in_array($segmentsURI[0],  Lang::pluck('code')->toArray())) {

            if ($segmentsURI[0] != self::$mainLanguage) return $segmentsURI[0];

        }

        return null;
    }

    /*
    * Устанавливает язык приложения в зависимости от метки языка из URL
    */
    public function get_url_withoutLocale()
    {
        $url = explode('/', request()->path());
        foreach (self::$languages as $num => $land) {
            if (isset($url[0])) {
                if ($url[0] == $land) {
                    unset($url[0]);

                }
            }
        }

        $return_url = implode('/', $url);
        $return_url = trim($return_url, '/');

        return '/' . $return_url;
    }

    public function need_url($the_full_url, $locale)
    {
        if ($locale != 'en') {
            $the_full_url = '/' . trim($locale . $the_full_url, '/');
        }
        if (request()->path() != '/') {
            $req = '/' . request()->path();
        } else {
            $req = request()->path();
        }

        if ($the_full_url != $req) {
            return $the_full_url;
        }

        return null;

    }

    public function handle($request, Closure $next)
    {
        if (\Str::contains(request()->url(), 'admin')) {
            return $next($request); //пропускаем дальше - передаем в следующий посредник
        }

        $the_full_url = $this->get_url_withoutLocale();
        $locale_url = self::getLocale();
        $lang_array = self::$languages;
        $raw_locale = Session::get('locale');
        if (in_array($raw_locale, $lang_array)) {  # Проверяем, что у пользователя в сессии установлен доступный язык
            $locale = $raw_locale;
            $need_utl = $this->need_url($the_full_url, $locale);

            if ($request->method() == 'GET' && request()->route()&&request()->route()->getName() != 'setlocale' && $need_utl) {

                return redirect($need_utl);
            }

            # (а не какая-нибудь бяка)
        } else {

            try {
                if (isset(request()->server()['HTTP_ACCEPT_LANGUAGE'])) {
                    $la = request()->server()['HTTP_ACCEPT_LANGUAGE'];

                    $lasr = explode(',', $la);
                    if (isset($lasr[0])) {

                        $lasr[0] = explode('-', $lasr[0]);

                    }

                    if (in_array($lasr[0][0], $lang_array)) {  # Проверяем, что у пользователя в сессии установлен доступный язык
                        $locale = $lasr[0][0];                         # (а не какая-нибудь бяка)
                    } else {
                        $locale = 'en';
                    }
                } else {
                    $locale = 'en';
                }
            } catch (\Exception $e) {
                $locale = 'en';
            }
            /* }*/
            $need_utl = $this->need_url($the_full_url, $locale);

            if ($request->method() == 'GET' && request()->route()&& request()->route()->getName() != 'setlocale' && $need_utl) {

                return redirect($need_utl);
            }

            if (!in_array($locale, self::$languages)) {
                $locale = 'ru';
            }

            Session::put('locale', $locale);
            \Config::set('mylocale', $locale);

            if ($request->method() == 'GET' && request()->route() && request()->route()->getName() != 'setlocale') {
                $need_utl = $this->need_url($the_full_url, $locale);
                if ($need_utl) {
                    return redirect($need_utl);
                }
            }

        }

        if ($locale) {
            App::setLocale($locale);

            //если метки нет - устанавливаем основной язык $mainLanguage
        } else {
            App::setLocale(self::$mainLanguage);
        }

        $locale = \App::getLocale();

        $lang = Lang::where('code', $locale)->first();
        if (!$lang) {
            $lang = Lang::where('code', 'en')->first();
        }
        if ($locale == 'en') {
            $locale = '';
        } else {
            $locale = '/' . $locale;
        }

        \View::share('locale', $locale);
        \View::share('lang', $lang);
        \Config::set('lang', $lang);

        \View::share('lang_array', $lang_array);

        return $next($request); //пропускаем дальше - передаем в следующий посредник
    }

}

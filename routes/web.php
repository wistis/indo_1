<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::post('/ajax', [\App\Http\Controllers\IndexController::class, 'ajax'])->name('ajax');
Route::get('/setlocale/{lang}', function ($lang) {

    $referer = Redirect::back()->getTargetUrl(); //URL предыдущей страницы
    $parse_url = parse_url($referer, PHP_URL_PATH); //URI предыдущей страницы
    Session::put('locale', $lang);
    //разбиваем на массив по разделителю
    $segments = explode('/', $parse_url);

    //Если URL (где нажали на переключение языка) содержал корректную метку языка
    if (in_array($segments[1], App\Http\Middleware\LocaleMiddleware::$languages)) {

        unset($segments[1]); //удаляем метку
    }

    //Добавляем метку языка в URL (если выбран не язык по-умолчанию)
    if ($lang != App\Http\Middleware\LocaleMiddleware::$mainLanguage){
        array_splice($segments, 1, 0, $lang);
    }

    //формируем полный URL
    $url = Request::root().implode("/", $segments);

    //если были еще GET-параметры - добавляем их
    if(parse_url($referer, PHP_URL_QUERY)){
        $url = $url.'?'. parse_url($referer, PHP_URL_QUERY);
    }
    session()->flash('setlocale');


    return redirect($url); //Перенаправляем назад на ту же страницу

})->name('setlocale');
Route::group(['prefix' => App\Http\Middleware\LocaleMiddleware::getLocale()], function() {
    Route::get('/', [\App\Http\Controllers\IndexController::class, 'index'])->name('index');
    Route::get('/ad/{id}', [\App\Http\Controllers\IndexController::class, 'ad'])->name('ad');
    Route::get('/contacts', [\App\Http\Controllers\IndexController::class, 'contacts'])->name('contacts');
    Route::get('/page/{url}', [\App\Http\Controllers\IndexController::class, 'page']);
    Route::get('/blogs', [\App\Http\Controllers\BlogController::class, 'index']);
    Route::get('/blogs/{url}', [\App\Http\Controllers\BlogController::class, 'show']);
    Route::get('/getAds', [\App\Http\Controllers\AdsController::class, 'getAds']);

});

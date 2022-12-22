<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Company;
use App\Models\Post;
use App;

class IndexController extends Controller
{
    public function index()
    {

        $comps = Company::where('status', 1)->orderby('amount', 'desc')->take(7)->get();
        $ads_sql = $this->get_ads();
        $ads = $ads_sql->paginate(5);

        return view('index', compact('comps', 'ads'));
    }

    public function ajax()
    {
        $ads_sql = $this->get_ads();
        $ads = $ads_sql->paginate(5);

        $date['html'] = view('_ad', compact('ads'))->render();
        $date['last']=$ads->lastPage();
        return $date;
    }

    public function get_ads()
    {
        $ads_sql = Ad::where('company_id', '>', 0);
        if (request('company') != '') {
            $ads_sql->where('company_id', request('company'));
        }
        if (request('q') != '') {
            $ads_sql->where(function($q) {
                $q->orwhere('name_' . App::getLocale(), 'LIKE', '%' . request('q') . '%');
                $q->orwhere('description_' . App::getLocale(), 'LIKE', '%' . request('q') . '%');

            });
        }
        if (request()->location != '') {
            $ads_sql->whereHas('locations', function($q) {
                $q->whereIN('location_id', request('location'));
            });
        }

        if (request('price') == 'latest') {
            $ads_sql->orderby('public_at', 'desc');
        }
        if (request('price') == 'highest') {
            $ads_sql->orderby('salary_to', 'desc');
        }
        if (is_array(request('salary'))) {

            $ads_sql->where(function($q) {
                foreach (App\Models\Salary::whereIN('id', request('salary'))->get() as $salary) {
                    /*   $ad->salary_from=$salary_start;
                                            $ad->salary_to=$salary_end;*/
                    if ($salary->znak == '>=') {
                        $q->orwhere('salary_from', '>=', $salary->value);
                    }
                    if ($salary->znak == '==') {
                        $q->orwhere('salary_from', '==', $salary->value);
                        $q->orwhere('salary_to', '==', $salary->value);
                    }
                    if ($salary->znak == '<=') {
                        $q->orwhere('salary_to', '<=', $salary->value);
                    }
                    if ($salary->znak == 'RANGE') {
                        $q->orwhere(function($q) use ($salary) {

                            $q->where('salary_from', '>=', $salary->value);
                            $q->where('salary_to', '>=', $salary->value2);

                        });
                    }

                }
            });

        }



        return $ads_sql;

    }

    public function ad($id)
    {
        $ad = Ad::findOrFail($id);

        return view('ad', compact('ad'));
    }

    public function page($url)
    {
        $post = Post::where('slug', $url)->where('footer', 1)->firstOrFail();

        return view('page', compact('post'));
    }

    public function contacts()
    {
        return view('contacts');
    }
}

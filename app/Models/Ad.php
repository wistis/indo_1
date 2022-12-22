<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App;

class Ad extends Model
{
    public function getNameAttribute()
    {

        return $this->{'name_' . App::getLocale()};
    }
    public function getDescriptionAttribute()
    {
$str=str_replace('\n\n','<br>',$this->{'description_' . App::getLocale()});
$str=str_replace('\n','<br>',$str);
        return $str;
    }

    public function getLogoAttribute()
    {

        if (is_file(public_path('images/company_logos/' . $this->job_id . '/logo.jpg'))) {
            return '/images/company_logos/' . $this->job_id . '/logo.jpg';

        }

        return NULL;

    }

    public function locations()
    {

        return $this->belongsToMany(Location::class, AdLocation::class);

    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function getShortAttribute()
    {
        $str = $this->{'description_' . \App::getLocale()};
        $str = strip_tags($str);
        $str = str_replace('\n', '', $str);

        $str = \Illuminate\Support\Str::limit($str, $limit = 150, $end = '<a class="offer__lead-more" href="/ad/' . $this->id . '">
                                            more
                                            <span class="material-symbols-outlined">
                        arrow_right_alt
                      </span>
                                        </a>');

        return $str;
    }
}

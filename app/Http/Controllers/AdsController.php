<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\AdLocation;
use App\Models\Company;
use App\Models\Location;
use App\Models\Remoteok;

class AdsController extends Controller
{
    public function index()
    {

    }

    public function getAds()
    {
        $pars = Remoteok::get();

        $data = [];
        foreach ($pars as $par) {
            $ad = Ad::where('job_id', $par->job_id)->first();
            if (!$ad) {
                $loc_ids=[];
                if ($par->location != '') {
                    $array_loc = explode(',', $par->location);
                    foreach ($array_loc as $locs) {
                        $loc = Location::where('name_en', $locs)->first();
                        if (!$loc) {
                            $loc = new Location();
                            $loc->name_en = $locs;
                            $loc->save();
                        }
                        $loc_ids[]=$loc->id;
                    }

                }
                if ($par->company_title != '') {
                    $comp = Company::where('name_en', $par->company_title)->first();
                    if (!$comp) {
                        $comp = new Company();
                        $comp->name_en = $par->company_title;
                        $comp->status=1;
                        $comp->save();
                    }
                }
                if ($par->salary != '') {
                    $salary = explode('-', $par->salary);
                    if (count($salary) == 2) {
                        $salary_start = $this->trim_salary($salary[0]);
                        $salary_end = $this->trim_salary($salary[1]);

                    }
                    /*$90k - $100k*/

                }

                $ad = new Ad();
                if (isset($comp)) {
                    $ad->company_id = $comp->id;
                }
                    $ad->name_en=$par->job_title;
                    $ad->description_en=$par->full_description;
                    $ad->public_at=$par->date;
                    $ad->job_id=$par->job_id;
                    $ad->job_link=$par->job_link;
                    if(isset($salary_start)){
                        $ad->salary_from=$salary_start;
                        $ad->salary_to=$salary_end;
                    }
                    $ad->save();
                    if(isset($loc_ids)&&count($loc_ids)>0){
                        foreach ($loc_ids as $l){
                            $adsal=new AdLocation();
                            $adsal->ad_id=$ad->id;
                            $adsal->location_id=$l;
                            $adsal->save();
                        }
                    }

            }

        }
        $comps=Company::get();
        foreach ($comps as $comp){
            $comp->amount=Ad::where('company_id',$comp->id)->count();
            $comp->save();
        }

    }

    function trim_salary($s)
    {
        $s = trim($s);
        $s = str_replace('$', '', $s);
        $s = str_replace('k', '', $s);
        $s = str_replace('*', '', $s);
        $s = $s * 1000;

        return $s;
        /*$90k - $100k*/
    }
}

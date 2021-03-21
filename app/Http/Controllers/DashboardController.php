<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\{
    Company, 
    Provider, 
    Schedule,
    Status
};

class DashboardController extends Controller
{
    public function companyIndex()
    {
        $status = Status::all();

        $company = Company::firstWhere('user_id', Auth::id());
        if ($company != null)
            $company_schedules = Schedule::where('company_id', $company->id)->get();
        else
            $company_schedules = [];

        $stars[0] = 0;
        $stars[1] = 0;
        $stars[2] = 0;
        $stars[3] = 0;
        $stars[4] = 0;

        foreach($company->schedules()->with('ratings')->get() as $schedule) {
            if ($schedule->ratings != null) {
                if ($schedule->ratings->rate == 1) {
                    $stars[0] = $stars[0] + 1;
                } else if ($schedule->ratings->rate == 2) {
                    $stars[1] = $stars[1] + 1;
                } else if ($schedule->ratings->rate == 3) {
                    $stars[2] = $stars[2] + 1;
                } else if ($schedule->ratings->rate == 4) {
                    $stars[3] = $stars[3] + 1;
                } else if ($schedule->ratings->rate == 5) {
                    $stars[4] = $stars[4] + 1;
                }
            }
        }

        return view(
            'dashboard.company.index', 
            compact(
                [
                    'status',

                    'company', 
                    'company_schedules', 
                    'stars'
                ]
            )
        );
    }

    public function providerIndex()
    {
        $status = Status::all();

        $provider = Provider::firstWhere('user_id', Auth::id());
        
        if ($provider != null) {
            $provider_schedules = Schedule::where('provider_id', $provider->id)->get();
        } else {
            $provider_schedules = [];
        }

        $stars[0] = 0;
        $stars[1] = 0;
        $stars[2] = 0;
        $stars[3] = 0;
        $stars[4] = 0;

        foreach($provider->schedules()->with('ratings')->get() as $schedule) {
            if ($schedule->ratings != null) {
                if ($schedule->ratings->rate == 1) {
                    $stars[0] = $stars[0] + 1;
                } else if ($schedule->ratings->rate == 2) {
                    $stars[1] = $stars[1] + 1;
                } else if ($schedule->ratings->rate == 3) {
                    $stars[2] = $stars[2] + 1;
                } else if ($schedule->ratings->rate == 4) {
                    $stars[3] = $stars[3] + 1;
                } else if ($schedule->ratings->rate == 5) {
                    $stars[4] = $stars[4] + 1;
                }
            }
        }

        return view(
            'dashboard.provider.index', 
            compact(
                [
                    'status',
                    
                    'provider', 
                    'provider_schedules',
                    'stars'
                ]
            )
        );
    }
}

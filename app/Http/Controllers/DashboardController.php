<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\{Company, Provider, Schedule};

class DashboardController extends Controller
{
    public function index()
    {
        $company = Company::firstWhere('user_id', Auth::id());
        if ($company != null)
            $company_schedules = Schedule::where('company_id', $company->id)->get();
        else
            $company_schedules = [];

        $provider = Provider::firstWhere('user_id', Auth::id());
        if ($provider != null)
            $provider_schedules = Schedule::where('provider_id', $provider->id)->get();
        else
            $provider_schedules = [];

        return view(
            'dashboard.index', 
            compact(
                [
                    'company', 
                    'company_schedules', 
                    
                    'provider', 
                    'provider_schedules'
                ]
            )
        );
    }
}

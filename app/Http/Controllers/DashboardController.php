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

        return view(
            'dashboard.company.index', 
            compact(
                [
                    'status',

                    'company', 
                    'company_schedules', 
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

        //dd($provider->schedules()->with('ratings')->get());
        
        return view(
            'dashboard.provider.index', 
            compact(
                [
                    'status',
                    
                    'provider', 
                    'provider_schedules'
                ]
            )
        );
    }
}

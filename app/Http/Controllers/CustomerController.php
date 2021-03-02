<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\{
  Provider,
  Company
};

use DB;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $companies = Company::where('inactive', 0)->get();
      $providers = Provider::where('inactive', 0)->get();

      $list = $companies->mergeRecursive($providers);
      
      return view('customers.index', compact('list'));
    }
}

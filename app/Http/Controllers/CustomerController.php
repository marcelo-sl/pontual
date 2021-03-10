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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
      $companies = Company::where('trade_name', 'like', '%'.$request->search.'%')->where('inactive', 0)->get();
      // dd($companies);
      $providers = Provider::where('nickname', 'like', '%'.$request->search.'%')->where('inactive', 0)->get();
      
      $list = $companies->mergeRecursive($providers);
      
      return view('customers.index', compact('list'));
    }
}

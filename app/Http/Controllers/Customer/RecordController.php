<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AddCustomer;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;

class RecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {   
        AddCustomer::destroy($id);
        return redirect('/customer/view')->with('success', 'customer deleted load history');
    }
        
    public function records ($id)
    {
      $list = DB::table('customers')
      ->join('add_customers', 'customers.id', '=', 'add_customers.customer_id')
      ->where('add_customers.customer_id', $id)
      ->get();

      $customers = DB::table('customers')
      ->where('id', $id)
      ->first();

      return view('customer.recordsCustomer')
      ->with(compact('list'))
      ->with(compact('customers'));
    }
}
    
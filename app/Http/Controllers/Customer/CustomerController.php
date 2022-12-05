<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCustomerRequest;
use App\Http\Resources\CustomerCreateResource;
use App\Services\API\CustomerService;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\AddCustomer;
use Illuminate\Support\Facades\DB;
use Validate;
use Exception;

class CustomerController extends Controller
{
    /** @var App\Services\API\CustomerService */
    protected $customerService;

    /**
     * UserController constructor.
     *
     * @param App\Services\API\CustomerService $customerService
     */

    /**
     * UserController constructor.
     *
     * @param App\Services\API\CustomerService $customerService
     */
    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('customer.customer');
    }

    public function home()
    {
        
       return view('layout.home');
    }

    // list of customers
    public function view()
    {
        $customers = Customer::all();
        return view('customer.viewCustomer')->with('list', $customers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * 
     * create customer account
     */
    public function store(CreateCustomerRequest $request)
    {
        $request->validated();
        try {   
            $formData = [
                'firstname' =>  $request->getFirstname(),
                'lastname' =>  $request->getLastname(),
                'details' =>  $request->getDetails(),
            ];

            $customer = $this->customerService->create($formData);
            
            $this->response['data'] = new CustomerCreateResource($customer);
        } catch (Exception $e) {
            $this->response = [
                'error' => $e->getMessage(),
                'code' => 500,
            ];
        }// @codeCoverageIgnoreEnd
        return redirect('/customer')->with('success', 'Customer Created');
    }

    /**
     * Delete user.
     *
     * @param string $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        try {
            // perform user delete
            $this->response['deleted'] = $this->customerService->delete((int) $id);
        } catch (Exception $e) {
            $this->response = [
                'error' => $e->getMessage(),
                'code' => 500,
            ];
        }

        return redirect('/customer/view')->with('success', 'Deleted');
    }

    public function destroy($id)
    {
        Customer::destroy($id);
        return redirect('/customer/view')->with('success', 'Deleted');
    }

    public function edit($id)
    {   
        $data = Customer::where('id',$id)->first();
        return view('customer.editCustomer')->with('list', $data);
    }

    public function update(Request $params)
    {   
        Customer::where('id', $params->id)
        ->update([
               'firstname' => $params->firstname,
               'lastname' => $params->lastname,
               'details' => $params->details
        ]);
        return redirect('/customer/view')->with('success', 'Updated Amount');

    }
}

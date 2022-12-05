<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Services\API\HomeService;
use Exception;

class HomeController extends Controller
{
    /**
     * UserController constructor.
     *
     * @param App\Services\API\HomeService $homeService
     */
    public function __construct(HomeService $homeService)
    {
        $this->homeService = $homeService;
    }

    public function index()
    {
        $accountFirst = $this->homeService->totalAccount();
        $customerCount = $this->homeService->totalCustomer();
        $percent = $this->homeService->percentCustomerCount();
        // dd($totalDebt);
        try {   

            // $this->response['data'] = new CustomerCreateResource($customer);
        } catch (Exception $e) {
            return redirect('/')->with('fail', 'Incorrect Email / Password');
        }// @codeCoverageIgnoreEnd

        return view('layout.home')
        ->with(compact('accountFirst'))
        ->with(compact('customerCount'))
        ->with(compact('percent'));
        // return view('layout.home')->with('list', $home);
    }
}

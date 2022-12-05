<?php

namespace App\Services\API;

use App\Exceptions\AccountNotCreatedFoundException;
use App\Services\API\AccountService;
use App\Services\API\CustomerService;
use App\Models\Account;
use DB;

class HomeService
{
   
    /**
     *
     *
     * @param App\Services\API\AccountService $accountService
     * @param App\Services\API\CustomerService $customerService
     */
    public function __construct(AccountService $accountService, CustomerService $customerService)
    {
        $this->accountService = $accountService;
        $this->customerService = $customerService;
    }
    public function totalAccount()
    {
        try {
            $account = $this->accountService->accounts();
            // $accountFirst = $account->first();
            $accountFirst = DB::table('accounts')
            ->orderBy('id', 'DESC')
            ->first();
            // dd($test);
        } catch (Exception $e) {
            DB::rollback();

            throw $e;
        }

        return $accountFirst;
    }

    public function totalCustomer()
    {
        try {
            $customer = $this->customerService->getCustomer();
            $customerCount = $customer->count();

        } catch (Exception $e) {
            DB::rollback();

            throw $e;
        }

        return $customerCount;
    }

    public function percentCustomerCount()
    {
        try {
            $totalNumber = 100;
            $number = $this->totalCustomer();
            $percent = ($number / $totalNumber) * 100;
            // dd($percent);
      
        } catch (Exception $e) {
            DB::rollback();

            throw $e;
        }

        return $percent;
    }

}
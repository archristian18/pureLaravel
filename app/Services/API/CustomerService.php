<?php

namespace App\Services\API;

use App\Exceptions\CustomerCreatedFailException;
use App\Models\Customer;
use DB;

class CustomerService
{

    /**
     * @var App\Models\Customer
     */
    protected $customer;

    
    /**
     * AccountService constructor.
     *
     * @param App\Models\Customer $customer
     */
    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    public function create(array $params)
    {
        DB::beginTransaction();

        try {
            $customers = $this->customer->create($params); 

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();

            throw $e;
        }
        
        return $customers;
    }

    public function getCustomer()
    {
        DB::beginTransaction();

        try {
            $customers =$this->customer->all();
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();

            throw $e;
        }

        return $customers;
    }

    public function getTotals($id)
    {
        DB::beginTransaction();

        try {
            $list = DB::table('customers')
            ->join('add_customers', 'customers.id', '=', 'add_customers.customer_id')
            ->where('add_customers.customer_id', $id)
            ->orderBy('customers.id', 'DESC')
            ->get();

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();

            throw $e;
        }

        return $list;
    }

    /**
     * Retrieves a customer by id
     *
     * @param int $id
     * @return User $customer
     */
    public function findById(int $id)
    {
        // retrieve the user
        $customer = $this->customer->find($id);

        if (!($customer instanceof User)) {
            throw new CustomerNotFoundException;
        }

        return $customer;
    }

    public function delete()
    {
        DB::beginTransaction();

        try {
            // retrieve users
            $customer = $this->findById($id);

            $this->customer->delete();
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();

            throw $e;
        }

        return true;
    }

}
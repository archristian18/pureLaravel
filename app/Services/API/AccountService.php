<?php

namespace App\Services\API;

use App\Exceptions\AccountNotCreatedFoundException;
use App\Models\Account;
use DB;

class AccountService
{

    /**
     * @var App\Models\Account
     */
    protected $account;

    
    /**
     * AccountService constructor.
     *
     * @param App\Models\Account $account
     */
    public function __construct(Account $account)
    {
        $this->account = $account;
    }

    public function create(array $params)
    {
        try {
            $total = $this->account->orderBy('id', 'DESC')
            ->first();  

            if($total == NULL)
            {
                $total=0;
                $updateGcash = $total + $params['gcash'];
                $updateLoad = $total + $params['wallet'];
            } else {
                $updateGcash = $total->gcash + $params['gcash'];
                $updateLoad = $total->loads + $params['wallet'];
            }

            $account = $this->account->create([
                'gcash' =>  $updateGcash,
                'loads' => $updateLoad
            ]);

            if (!($account)) {
                throw new AccountNotCreatedFoundException;
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();

            throw $e;
        }

        return $account;
    }

    public function accounts()
    {
        
        try {
            $data =$this->account->all();
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();

            throw $e;
        }

        return $data;
    }

}
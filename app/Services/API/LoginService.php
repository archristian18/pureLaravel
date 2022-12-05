<?php

namespace App\Services\API;

use App\Exceptions\LoginNotFoundException;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Exception;
use DB;

class LoginService
{

    /**
     * @var App\Models\User
     */
    protected $users;

    
    /**
     * AccountService constructor.
     *
     * @param App\Models\User $users
     */
    public function __construct(User $users)
    {
        $this->user = $users;
    }

    public function authLogin(array $params)
    {
        try {
                               
            if (Auth::attempt(['email' => $params['email'], 'password' =>  $params['password']])) {
             
                $users = Auth::$this->user();
                $token = $users->createToken('Token Name')->accessToken;
            } 
            
            // Check user exist
            $login =  $this->user->where('email', $params['email'])
            ->where('password', $params['password'])
            ->first();

            if ($login == NULL) {
                throw new LoginNotFoundException;
            }
     
            DB::commit();   
        } catch (Exception $e) {
            DB::rollback();

            throw $e;
        }

    }

}
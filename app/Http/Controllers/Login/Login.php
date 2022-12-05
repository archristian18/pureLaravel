<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Hash;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        $request->validated();
        try {   
            $formData = [
                'email' =>  $request->getEmail(),
                'password' =>  $request->getPassword(),
            ];
        } catch (Exception $e) {
            $this->response = [
                'error' => $e->getMessage(),
                'code' => 500,
            ];
        }// @codeCoverageIgnoreEnd
        return redirect('/login');
    }
    public function register()
    {
        return view('Auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);
           
        $data = $request->all();
        $check = $this->create($data);
        return redirect("registration")->withSuccess('You have signed-in');

    }

    public function create(array $data)
    {
      User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => $data['password']
        // 'password' => Hash::make($data['password'])
      ]);
    
    }    
    
    public function data()
    {
        return redirect("/login")->withSuccess('You are not allowed to access');
    }

}

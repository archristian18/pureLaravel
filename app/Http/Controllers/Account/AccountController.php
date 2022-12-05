<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CreateAccountMoneyRequest;
use App\Http\Resources\AccountResource;
use App\Services\API\AccountService;
use App\Models\Account;
use Validate;
use Exception;

class AccountController extends Controller
{
    /** @var App\Services\API\AccountService */
    protected $accountService;

    /**
     * UserController constructor.
     *
     * @param App\Services\API\AccountService $accountService
     */

    /**
     * UserController constructor.
     *
     * @param App\Services\API\AccountService $accountService
     */
    public function __construct(AccountService $accountService)
    {
        $this->accountService = $accountService;
    }

    public function index()
    {
        return view('account.addAccount');
    }

    public function histories()
    {
        try {
            $account = $this->accountService->accounts();
        } catch (Exception $e) {
            $this->response = [
                'error' => $e->getMessage(),
                'code' => 500,
            ];
        }// @codeCoverageIgnoreEnd
        return view('account.viewAccount')->with('list', $account);
      
    }

    public function loads(CreateAccountMoneyRequest $request)   
    {
        $request->validated();
        try {
            $formData = [
                'gcash' =>  $request->getGcash(),
                'wallet' =>  $request->getWallet(),
            ];
   
            $account = $this->accountService->create($formData);
            $this->response['data'] = new AccountResource($account);
        } catch (Exception $e) {
            $this->response = [
                'error' => $e->getMessage(),
                'code' => 500,
            ];
        }// @codeCoverageIgnoreEnd
        return redirect('/account/view')->with('success', 'Added Amount');
    }

    public function destroy($id)
    {   
        Account::destroy($id);
        return redirect('/account/view')->with('success', 'Deleted Amount');
    }

    public function createPDF () {
        // Retrieve all products from the db
        $products = Product::all();
        view()->share ('products', $products);
        $pdf = PDF ::loadView ('index', $products);
        return $pdf->download ('file-pdf.pdf');
    }

    public function edit($id)
    {   
        $data = Account::where('id',$id)->first();
        return view('account.editAccount')->with('list', $data);
    }

    public function update(Request $params)
    {   
        Account::where('id', $params->id)
        ->update([
               'gcash' => $params->gcash,
               'loads' => $params->loads
        ]);
        return redirect('/account/view')->with('success', 'Updated Amount');
    }

}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // Custom code for Auth process
    protected function credentials( Request $request )
    {
        $credentials = $request->only($this->username(), 'password');

        $credentials['is_use'] = 1;

        return $credentials;

    }

    protected function sendFailedLoginResponse(Request $request)
    {
          
        throw ValidationException::withMessages([
            // $this->username() => [trans('auth.falied')],
            $this->username() => [trans('auth.failed')],
        ]);
        
    }
}

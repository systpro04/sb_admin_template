<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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

    public function username() {
        return 'username';
    }
    protected function sendFailedLoginResponse(Request $request)
    {
        toastr()->success('Invalid credentials. Please try again.', 'Login Failed', ['iconClass' => 'toast-error']);
        return redirect()->back()->withInput($request->only($this->username(), 'remember'))->withErrors(['username' => trans('auth.failed')]);
    }
    protected function authenticated(Request $request, $user)
    {
        toastr()->success('Login Successfully', 'Welcome back, ' . $user->name, ['iconClass' => 'toast-success']);
        return redirect()->route('home');
    }
    protected function loggedOut(Request $request)
    {
        toastr()->success('Logout Successfully', 'Success', ['iconClass' => 'toast-success']);
        return redirect('login');
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {

         $input = $request->all();

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password'])))
        {
            switch (auth()->user()->role) {
                case 'teacher':
                    return redirect()->route('teacher.schedule.index');
                    break;
                case 'admin':
                    return redirect()->route('admin.dashboard.index');
                    break;
                default:
                    abort(403);
                    break;
            }
        }else{
            return redirect()->route('welcome')
                ->with('error','Invalid Credentials');
        }

    }

    public function signout(){
        Session::flush();
        Auth::logout();
        return redirect()->route('welcome');
    }
}

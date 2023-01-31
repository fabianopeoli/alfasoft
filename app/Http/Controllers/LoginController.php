<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function index(Request $request){
        return view('users.login');
    }

    /**
     * Authenticates users
     *
     * @param Request $request
     * @return void
     */
    public function authenticate(Request $request)
    {
        $rules = [
            'email'    => 'required|email',
            'password' => 'required|between:3,12'
        ];

        $request->validate($rules);

        $credentials = $request->only(['email', 'password']);

        if (Auth::attempt($credentials,$request->remember)) {
            $request->session()->regenerate();

            return redirect()->intended('/');;
        }

        return redirect()->back()->with('error', 'Usuário ou senha inválidos');
    }

    /**
     * Logout users
     *
     * @return void
     */
    public function logout(Request $request, $redirect = true){
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        if($redirect){
            return redirect(route('user.index'));
        }
    }
}
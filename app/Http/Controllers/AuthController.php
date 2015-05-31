<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Auth;


class AuthController extends Controller {
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    public function index() {
        return view('auth.login');
    }

    public function login() {
        $email = Request::input('email');
        $password = Request::input('password');

        $rules = array('email' => 'required', 'password' => 'required');
        $validator = Validator::make(array(
            'email' => $email,
            'password' => $password
        ),$rules);

        if ($validator->fails()) {
            return Redirect::route('login')->withErrors($validator);
        }

        $auth = Auth::attempt(array(
            'email' => $email,
            'password' => $password
        ), false);

        if (!$auth) {
            return Redirect::route('login')->withErrors(array(
                'Invalid email or password'
            ));
        }

        return Redirect::route('home');
    }
}

?>

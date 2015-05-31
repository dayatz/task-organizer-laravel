<?php namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Auth;
use Hash;

class SignupController extends Controller {
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index() {
        return view('auth.signup');
    }

    public function signup() {
        $name = Request::input('name');
        $email = Request::input('email');
        $password = Request::input('password');

        $rules = array('name' => 'required', 'email' => 'required', 'password' => 'required');
        $validator = Validator::make(array(
            'name' => $name,
            'email' => $email,
            'password' => $password
        ),$rules);

        if ($validator->fails()) {
            return Redirect::route('signup')->withErrors($validator);
        }

        try {
            $user = new User;
            $user->name = $name;
            $user->email = $email;
            $user->password = Hash::make($password);
            $user->save();

            $auth = Auth::attempt(array(
                'email' => $email,
                'password' => $password
            ), false);
            return Redirect::route('home');
        } catch (\Exception $e) {
            return Redirect::route('signup')->withErrors(array(
                'Something is wrong with this field!'
            ));
        }
    }
}

?>

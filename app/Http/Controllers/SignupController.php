<?php namespace App\Http\Controllers;

class SignupController extends Controller {
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index() {
        return view('signup');
    }

    public function signup() {
        return "signup page";
    }
}

?>

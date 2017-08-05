<?php

namespace SON\Http\Controllers\Auth;

use Illuminate\Http\Request;
use SON\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
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
        $this->middleware('guest');
    }

    protected function credentials(Request $request)
    {
        $data = $request->only($this->username(), 'password', 'password_confirmation', 'token');
        $usernameKey = $this->usernameKey();
        $data[$usernameKey] = $data[$this->username()];
        unset($data[$this->username()]);
        return $data;
    }

    protected function rules()
    {
        $userValidation = $this->usernameKey() === 'email' ? '|email' : "";
        $rules = [
            'token' => 'required',
            "{$this->username()}" => 'required'.$userValidation,
            'password' => 'required|confirmed|min:6',
        ];
        return $rules;
    }

    protected function usernameKey()
    {
        $email = \Request::get($this->username());
        $validator = \Validator::make([
            'email' => $email
        ], ['email' => 'email']);

        return $validator->fails() ? "enrolment" : "email";
    }

    protected function sendResetFailedResponse(Request $request, $response)
    {
        return redirect()->back()
            ->withInput($request->only($this->username()))
            ->withErrors([$this->username() => trans($response)]);
    }

    public function username()
    {
        return 'username';
    }
}

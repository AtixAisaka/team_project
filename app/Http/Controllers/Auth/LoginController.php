<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
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
    public function github(){
        return Socialite::driver('github')->redirect();
    }
    public function githubRedirect(){
        try {
            $user = Socialite::driver('github')->user();
        } catch (Exception $e) {
            return redirect('login');
        }
        $authUser = $this->findOrCreateUser($user);
        Auth::login($authUser, true);
        return redirect('/');
    }

    /** Return user if exists; create and return if doesn't
     *
     * @param $githubUser
     * @return User
     **/
    private function findOrCreateUser($githubUser)
    {
        if ($authUser = User::where('email', $githubUser->email)->first()) {
            return $authUser;
        }

        return User::create([
            'name' => $githubUser->nickname,
            'email' => $githubUser->email,
            'id' => $githubUser->id,
            'password'=>$githubUser->token,
        ]);
    }

    public function facebook(){
        return Socialite::driver('facebook')->redirect();
    }
    public function facebookRedirect(){
        try {
            $user = Socialite::driver('facebook')->user();
        } catch (Exception $e) {
            return redirect('login');
        }

        $authUser = $this->findOrCreateUser2($user);

        Auth::login($authUser, true);

        return redirect('/');
    }
    private function findOrCreateUser2($facebookUser)
    {
        if ($authUser = User::where('email', $facebookUser->email)->first()) {
            return $authUser;
        }

        return User::create([
            'name' => $facebookUser->name,
            'email' => $facebookUser->email,
            'id' => $facebookUser->id,
            'password'=>$facebookUser->id,
        ]);
    }

    public function google(){
        return Socialite::driver('google')->redirect();
    }
    public function googleRedirect(){
        try {
            $user = Socialite::driver('google')->user();
        } catch (Exception $e) {
            return redirect('login');
        }

        $authUser = $this->findOrCreateUser3($user);

        Auth::login($authUser, true);

        return redirect('/');
    }
    private function findOrCreateUser3($googleUser)
    {
        if ($authUser = User::where('email', $googleUser->email)->first()) {
            return $authUser;
        }

        return User::create([
            'name' => $googleUser->name,
            'email' => $googleUser->email,
            'id' => $googleUser->id,
            'password'=>$googleUser->id,
        ]);
    }
}

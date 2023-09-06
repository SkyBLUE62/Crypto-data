<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function register_view()
    {
        return view('login/register');
    }

    public function login_view()
    {
        return view('login/login');
    }

    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'name' => 'required'
        ], [
            'email.required' => 'Le champ email est requis.',
            'email.email' => 'L\'email doit être une adresse email valide.',
            'email.unique' => 'Cette adresse email est déjà utilisée.',
            'password.required' => 'Le champ mot de passe est requis.',
            'password.min' => 'Le mot de passe doit contenir au moins :min caractères.',
            'name.required' => 'Le champ nom est requis.'
        ]);

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->save();

        $accessToken = $user->createToken('authToken')->plainTextToken;
        Auth::login($user);
        return redirect('/home')->with('accessToken', $accessToken);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'L\'adresse e-mail est requise.',
            'email.email' => 'L\'adresse e-mail doit être une adresse e-mail valide.',
            'password.required' => 'Le mot de passe est requis.',
        ]);

        if (Auth::attempt($credentials)) {
            $accessToken = auth()->user()->createToken('authToken')->plainTextToken;
            return redirect('/home')->with('success', 'Logged in successfully')->with('accessToken', $accessToken);
        } else {
            return redirect('/signin')->with('error', 'L\Email ou le mot de passe est incorrect');
        }
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        auth()->guard('web')->logout();
        return view('login.logout');
    }

    // /**
    //  * Redirect the user to the Google authentication page.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function redirectToProvider()
    // {
    //     return Socialite::driver('google')->redirect();
    // }


    // /**
    //  * Obtain the user information from Google.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function handleProviderCallback()
    // {
    //     $user = Socialite::driver('google')->user();

    //     $authUser = $this->findOrCreateUser($user);
    //     Auth::login($authUser, true);

    //     return redirect('/home');
    // }

    // /**
    //  * Return user if exists; create and return if doesn't
    //  *
    //  * @param $googleUser
    //  * @return User
    //  */
    // private function findOrCreateUser($googleUser)
    // {
    //     $authUser = User::where('email', $googleUser->email)->first();
    //     if ($authUser) {
    //         return $authUser;
    //     }
    //     return User::create([
    //         'name' => $googleUser->name,
    //         'email' => $googleUser->email,
    //         'password' => '',
    //     ]);
    // }

}

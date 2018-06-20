<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Socialite;
use Illuminate\Http\Request;
use App\Provider;
use App\User;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function redirectToProvider($provider)
    {
//        dd(Socialite::driver('facebook')->user());

        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();
//        dd($user);
//        $authUser = $this->findOrCreateUser($user, $provider);
//        Auth::login($authUser, true);

        // Code in function handleProviderCallback

        $selectProvider = Provider::where('provider_id', $user->getId())->first();

        if(!$selectProvider){
            // new user

            $userGetReal = User::where('email', $user->getEmail())->first();

            if(!$userGetReal){
                $userGetReal = new User();
                $userGetReal->name = $user->getName();
                $userGetReal->email= $user->getEmail();
                $userGetReal->status= 1;
                $userGetReal->save();
            }

            $newprovider = new Provider();
            $newprovider->provider_id = $user->getId();
            $newprovider->provider = $provider;
            $newprovider->user_id = $userGetReal->id;

            $newprovider->save();


        }else{
            // login user
            $userGetReal = User::find($selectProvider->user_id);
        }

        auth()->login($userGetReal);
        return Redirect('/');

// End Code

//        return redirect($this->redirectTo);
    }
}



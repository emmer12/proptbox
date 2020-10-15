<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\User;
use App\Social as SocialAccount;
use Carbon\Carbon;
use Illuminate\Support\Str;


class SocialAuthController extends Controller
{
    public function redirectToProvider($provider)
    {
        $url = Socialite::driver($provider)->stateless()->redirect()->getTargetUrl();

        return response()->json([
            "url" => $url
        ]);
    }



    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->stateless()->user();
        // dd($user);
        // return response()->json(['token'=>$user ]);
        if (!$user->token) {
            return response()->json([
                "success" => false,
                "message" => "Failed to login"
            ], 401);
        }

        $appUser = User::whereEmail($user->email)->first();

        if (!$appUser) {
            if (empty($user->email)) {
                $email=$user->name.'@facebook.com';
            }
            $email=$user->email;
            // create user and add the provider
            $newUser=true;
            $appUser = User::create([
                'fullname' => $user->name,
                'password' => Str::random(7),
                'email' => $email,
                'email_verified_at'=>Carbon::now()                
            ]);

            $socialAccount = SocialAccount::create([
                'provider' => $provider,
                'provider_user_id' => $user->id,
                'user_id' => $appUser->id
            ]);



        } else {
            // means that we have already this user
            $newUser=false;
            $socialAccount = $appUser->socialAccounts()->where('provider', $provider)->first();

            if (!$socialAccount) {
                // create social account
                $socialAccount = SocialAccount::create([
                    'provider' => $provider,
                    'provider_user_id' => $user->id,
                    'user_id' => $appUser->id
                ]);
            }

        }

        // login our user and get the token
        $passportToken = $appUser->createToken('proptbox-v1')->accessToken;

        return response()->json([
            'access_token' => $passportToken,
            'isUser'=>$newUser,
        ]);

    }

}
 













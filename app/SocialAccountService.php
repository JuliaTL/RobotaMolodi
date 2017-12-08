<?php

namespace App;

use Socialite;
use App\Models\User;
use Laravel\Socialite\Contracts\User as ProviderUser;
use App\Http\Controllers\oAuthController;
use GuzzleHttp\Client as GuzzleHttpClient;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class SocialAccountService
{
    public function createOrGetUser(ProviderUser $providerUser)
    {
        $account = User::whereProvider('facebook')
            ->whereProviderUserId($providerUser->getId())
            ->first();
        if ($account) {
            return $account->user;
        } else {
            $account = new User([
                'provider_user_id' => $providerUser->getId(),
                'provider' => 'facebook'
            ]);

            $user = User::whereEmail($providerUser->getEmail())->first();
            if (!$user) {
                $user = User::create([
                    'email' => $providerUser->getEmail(),
                    'name' => $providerUser->getName(),
                    'password' => 'rstuvwxyzABCDEFGH',
                    'provider_user_id' => $providerUser->getId(),
                    'provider' => 'facebook',
                ]);
            }
            $account->user()->associate($user);
            $account->save();

            return $user;
        }
    }

}

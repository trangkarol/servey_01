<?php

namespace App\Repositories\Socialite;

use Laravel\Socialite\Contracts\User as ProviderUser;
use App\Models\SocialAccount;
use App\Repositories\User\UserInterface;
use App\Repositories\BaseRepository;
use Carbon\Carbon;

class SocialAccountRepository extends BaseRepository
{
    protected $userRepository;

    public function __construct(SocialAccount $socialAccount, UserInterface $user)
    {
        parent::__construct($socialAccount);
        $this->userRepository = $user;
    }

    public function createOrGetUser(ProviderUser $providerUser, $provider)
    {
        $account = $this->where('provider', $provider)->where('provider_user_id', $providerUser->getId())->first();

        if ($account) {
            return $this->userRepository->find($account->user_id);
        } else {
            $user = $this->userRepository->where('email', $providerUser->getEmail())->first();

            if (!$user) {
                $user = $this->userRepository->firstOrCreate([
                    'email' => $providerUser->getEmail(),
                    'name' => $providerUser->getName(),
                    'password' => config('users.password_default'),
                    'image' => $providerUser->getAvatar(),
                    'level' => config('users.level.user'),
                    'status' => config('users.status.active'),
                ]);
            }

            $account = $this->create([
                'user_id' => $user->id,
                'provider_user_id' => $providerUser->getId(),
                'provider' => $provider,
            ]);

            return $user;
        }
    }
}

<?php

namespace App\Repositories\Socialite;

use Laravel\Socialite\Contracts\User as ProviderUser;
use App\Models\SocialAccount;
use App\Repositories\User\UserInterface;
use App\Repositories\BaseRepository;
use Carbon\Carbon;
use App\Models\User;
use App\Repositories\Socialite\CurrentSocialRepository;

class SocialAccountRepository extends BaseRepository
{
    protected $userRepository;
    protected $currentSocialRepsitory;

    public function __construct(
        SocialAccount $socialAccount, 
        UserInterface $userRepository,
        CurrentSocialRepository $currentSocialRepsitory
    ) {
        parent::__construct($socialAccount);
        $this->userRepository = $userRepository;
        $this->currentSocialRepsitory = $currentSocialRepsitory;
    }

    public function createOrGetUser(ProviderUser $providerUser, $provider)
    {
        $account = $this->where('provider', $provider)->where('provider_user_id', $providerUser->getId())->first();
        $user = null;

        if ($account) {
            $user = $this->userRepository->find($account->user_id);
            $currentSocial = $this->currentSocialRepsitory->where('user_id', $user->id)->first();
            $data = [
                'email' => $providerUser->getEmail(),
                'name' => $providerUser->getName(),
                'image' => $providerUser->getAvatar(),
            ];

            if ($providerUser->getEmail()) {
                $this->userRepository->newQuery(new User());
                $check = $this->userRepository
                    ->where('email', $providerUser->getEmail())
                    ->where('id', '<>', $user->id)
                    ->exists();
                $data = $check ? array_except($data, ['email']) : $data;
            }

            $currentSocial->fill($data);

            if ($currentSocial->getDirty()) {
                $currentSocial->save();
                $user->fill($data);
                $user->save();
            }

            return $user;
        }

        if ($providerUser->getEmail()) {
            $user = $this->userRepository->where('email', $providerUser->getEmail())->first();
        }

        if (!$user) {
            $user = $this->userRepository->firstOrCreate([
                'email' => $providerUser->getEmail(),
                'name' => $providerUser->getName(),
                'password' => config('users.password_default'),
                'image' => $providerUser->getAvatar(),
                'level' => config('users.level.user'),
                'status' => config('users.status.active'),
            ]);

            $this->currentSocialRepsitory->create([
                'email' => $providerUser->getEmail(),
                'name' => $providerUser->getName(),
                'image' => $providerUser->getAvatar(),
                'user_id' => $user->id,
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

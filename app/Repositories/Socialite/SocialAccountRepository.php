<?php

namespace App\Repositories\Socialite;

use Laravel\Socialite\Contracts\User as ProviderUser;
use App\Models\SocialAccount;
use App\Repositories\User\UserInterface;
use App\Repositories\BaseRepository;
use Carbon\Carbon;
use App\Models\User;

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
        $user = null;

        if ($account) {
            $user = $this->userRepository->find($account->user_id);
            $data = [
                'email' => $providerUser->getEmail(),
                'name' => $providerUser->getName(),
                'image' => $providerUser->getAvatar(),
            ];

            if ($providerUser->getEmail()) {
                $this->userRepository->newQuery(new User());
                $data = $this->userRepository
                    ->where('email', $providerUser->getEmail())
                    ->where('id', '<>', $user->id)
                    ->exists() ? array_except($data, ['email']) : $data;
            }

            $user->fill($data);

            if ($user->getDirty()) {
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
        }

        $account = $this->create([
            'user_id' => $user->id,
            'provider_user_id' => $providerUser->getId(),
            'provider' => $provider,
        ]);

        return $user;
    }
}

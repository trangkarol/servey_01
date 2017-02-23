<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use Carbon\Carbon;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        factory(User::class, 10)->create();
        factory(User::class)->create([
            'email' => 'admin@gmail.com',
            'name' => 'Admin',
            'password' => config('users.password_default'),
            'image' => config('users.avatar_default'),
            'phone' => config('users.phone_default'),
            'gender' => rand(0,1),
            'level' => config('users.level.admin'),
            'birthday' => Carbon::now()->format('Y-m-d'),
            'address' => config('users.address_default'),
        ]);
        factory(User::class)->create([
            'email' => 'supperadmin@gmail.com',
            'name' => 'Supper Admin',
            'password' => config('users.password_default'),
            'image' => config('users.avatar_default'),
            'phone' => config('users.phone_default'),
            'gender' => rand(0,1),
            'level' => config('users.level.supperadmin'),
            'birthday' => Carbon::now()->format('Y-m-d'),
            'address' => config('users.address_default'),
        ]);
    }
}

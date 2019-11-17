<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\User::class)->create([
            'email' => 'admin@user.com',
            'enrolment' => 100000
        ])->each(function(User $user){
            User::assignRole($user, User::ROLE_ADMIN);
            $user->save();
        });

        factory(\App\Models\User::class,5)->create([])->each(function (User $user) {
            if(!$user->userable)
            {
                User::assignRole($user, User::ROLE_TEACHER);
                User::assingEnrolment(new User(), User::ROLE_TEACHER);
                $user->save();
            }
        });

        factory(\App\Models\User::class,5)->create([])->each(function (User $user) {
            if (!$user->userable)
            {
                User::assignRole($user, User::ROLE_STUDENT);
                User::assingEnrolment($user, User::ROLE_STUDENT);
                $user->save();
            }
        });
    }
}

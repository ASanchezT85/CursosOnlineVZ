<?php

use Illuminate\Database\Seeder;

use App\User;
use App\Student;
use App\Teacher;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Administrator
        factory(User::class, 1)->create([
            'name'                  => 'Administrator',
            'slug'                  => 'administrator',
            'email'                 => 'admin@cursosonline.com',
            'email_verified_at'     => now(),
            'password'              => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',
            'remember_token'        => str_random(10)
        ])->each(function (User $user) {
            factory(Student::class, 1)->create(['user_id' => $user->id]);
            factory(Teacher::class, 1)->create(['user_id' => $user->id]);
            $user->roles()->sync(['1']);
        });

        //Students 
        factory(User::class, 50)
            ->create()
            ->each(function (User $user) {
                factory(Student::class, 1)->create(['user_id' => $user->id]);
                $user->roles()->sync(['3']);
            }
        );

        //Teacher
        factory(User::class, 10)
            ->create()
            ->each(function (User $user) {
                factory(Student::class, 1)->create(['user_id' => $user->id]);
                factory(Teacher::class, 1)->create(['user_id' => $user->id]);
                $user->roles()->sync(['2']);
            }
        );
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 50; $i++) {
            // Create user
            $user = User::create([
                'name' => "$faker->firstName $faker->lastName",
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password123'),
            ]);
            $user->assignRole('user');

            // Create student
            Student::create([
                'user_id' => $user->id,
                'first_name' => $faker->firstName,
                'middle_name' =>  $faker->lastName,
                'last_name' => $faker->lastName,
                'phone' => $faker->phoneNumber,
                'address' => $faker->address,
                'date_of_birth' => $faker->date(),
            ]);
        }
    }
}

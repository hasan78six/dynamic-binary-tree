<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\Console\Output\ConsoleOutput;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $output = new ConsoleOutput();

        $user = User::create([
            "name" => "Binary Tree",
            "email" => "hasanabbas78six@gmail.com",
            "password" => 't8Y4ccH3F5x5ajqf'
        ]);

        $token = $user->createToken('auth-token')->plainTextToken;

        $output->writeln('Following is the API Token: ' . $token);
    }
}

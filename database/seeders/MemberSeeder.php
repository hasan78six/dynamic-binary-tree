<?php

namespace Database\Seeders;

use App\Models\Member;
use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Member::create([
            'username' => 'binary',
            'name' => "Binary Tree",
            'sponsor_id' => null,
            'position' => "top"
        ]);
    }
}

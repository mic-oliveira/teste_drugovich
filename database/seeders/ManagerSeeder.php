<?php

namespace Database\Seeders;

use App\Models\Manager;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Manager::factory()->state(['email' => 'admin@admin.com', 'password' => Hash::make('admin'), 'access_level'=> 2])->create();
        Manager::factory()->state(['email' => 'teste@admin.com', 'password' => Hash::make('admin'), 'access_level'=> 1])->create();
        Manager::factory()->count(10)->create();
    }
}

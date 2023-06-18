<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => 123456789,
            'document_type' => 'C.C',
            'names' => 'Admin ',
            'surnames' => 'User',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('Admin12345'),
            'phone' => '3219315474',
            'status' => true,
            'id_category' => 1,
        ]);
    }
}

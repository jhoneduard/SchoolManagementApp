<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category_user')->insert([
            'id' => 1,
            'name' => 'Administrador',
        ]);

        DB::table('category_user')->insert([
            'id' => 2,
            'name' => 'Estudiante',
        ]);

        DB::table('category_user')->insert([
            'id' => 3,
            'name' => 'Docente',
        ]);
    }
}

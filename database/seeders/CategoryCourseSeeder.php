<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryCourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category_subject')->insert([
            'id' => 1,
            'name' => 'Desarrollo Web',
        ]);

        DB::table('category_subject')->insert([
            'id' => 2,
            'name' => 'Desarrollo Movil',
        ]);

        DB::table('category_subject')->insert([
            'id' => 3,
            'name' => 'Desarrollo Escritorio',
        ]);
        DB::table('category_subject')->insert([
            'id' => 4,
            'name' => 'Gestion de proyectos',
        ]);
        DB::table('category_subject')->insert([
            'id' => 5,
            'name' => 'Contabilidad y finanzas',
        ]);
        DB::table('category_subject')->insert([
            'id' => 6,
            'name' => 'Diseño',
        ]);
        DB::table('category_subject')->insert([
            'id' => 7,
            'name' => 'Gastronomia',
        ]);
    }
}

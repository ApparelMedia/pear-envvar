<?php

use Illuminate\Database\Seeder;

class ProjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('projects')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

        DB::table('projects')->insert([
            'name' => 'EnvVar',
            'dotenv_path' => '/',
        ]);
    }
}